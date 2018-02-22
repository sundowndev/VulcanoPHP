<?php
/**
 * @author      Raphaël Cerveaux <raphael@crvx.fr>
 * @copyright   Copyright (c), 2016 Raphaël Cerveaux
 * @license     MIT public license
 */

namespace App;

use \Bramus\Router\Router as Router;
use \App\DB\Database as Database;

/**
 * Class App
 */
class Application
{
	/**
     * @var bool
     */
	private $debug;
    
    /**
     * @var string The Server Base Path for Router Execution
     */
    private $serverBasePath;

	/**
     * @var instance
     */
	private $router;

	/**
     * @var instance
     */
	private $db;

	/**
     * @var instance
     */
	private $twigLoader;

	/**
     * @var instance
     */
	private $twig;

    /**
     * public variables
     */
	public $ROOT;
	public $WEBROOT;
	public $DIR_APP;
	public $DIR_CONFIG;
	public $DIR_RESOURCES;
	public $DIR_CONTROLLERS;
	public $DIR_MODELS;
	public $DIR_VIEWS;
	public $config;

	/**
     * Constructor
     */
	public function __construct (bool $debug = false)
	{
        // Initializing debug value
		$this->debug = $debug;
        
        // Enabling up PHP errors in development env
        if ($this->debug):
            ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		else:
			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			error_reporting(E_ALL);
        endif;
		
        // Router instance
        $this->ROOT = dirname(dirname($_SERVER['SCRIPT_FILENAME']));

        $this->WEBROOT = (dirname($_SERVER['SCRIPT_NAME']) != '/') ? dirname($_SERVER['SCRIPT_NAME']).'/' : dirname($_SERVER['SCRIPT_NAME']);

        $this->DIR_APP = $this->ROOT.'/app/';
		$this->DIR_CONFIG = $this->DIR_APP.'config/';
		$this->DIR_RESOURCES = $this->ROOT.'/Resources/';
		$this->DIR_MODELS = $this->DIR_RESOURCES.'models/';
		$this->DIR_VIEWS = $this->DIR_RESOURCES.'views/';
        $this->config = json_decode(file_get_contents($this->DIR_CONFIG.'/config.json'), true);

        foreach ($this->config['paths'] as $key => $path) {
            $this->config['paths'][$key] = $this->WEBROOT . $path;
        }

        // Setting up application private key
        // Private key is a sha256 string which allows you to hash passwords in a secure way
        $this->private_key = $this->config['framework']['private_key'];

        // Router instance
		$this->router = new Router();

        // Database instance
		$this->db = new Database($this->config['dbDns']['host'], $this->config['dbDns']['dbname'], $this->config['dbDns']['user'], $this->config['dbDns']['pass']);
        
        // TwigLoader and Twig instances
		\Twig_Autoloader::register();
		$this->twigLoader = new \Twig_Loader_Filesystem($this->DIR_VIEWS);
		$this->twig = new \Twig_Environment($this->twigLoader, array('debug' => $this->debug));

        $this->getTwig()->addGlobal('site', [
            'name' => $this->config['general']['site_name'],
            'description' => $this->config['general']['description'],
            'tags' => $this->config['general']['tags']
        ]);

        $this->getTwig()->addGlobal('paths', [
            'root' => $this->WEBROOT,
            'home' => $this->removeRegex($this->config['paths']['home']),
            'blog' => $this->removeRegex($this->config['paths']['blog']),
            'about' => $this->removeRegex($this->config['paths']['about']),
            'contact' => $this->removeRegex($this->config['paths']['contact']),
            'user' => $this->removeRegex($this->config['paths']['user']),
            'category' => $this->removeRegex($this->config['paths']['category']),
            'content' => $this->removeRegex($this->config['paths']['content']),
            'themes' => $this->removeRegex($this->config['paths']['themes']),
            'uploads' => $this->removeRegex($this->config['paths']['uploads']),
            'admin' => $this->removeRegex($this->config['paths']['admin'])
        ]);
	}

	private function __clone () {}

	public function __destruct () {}

    private function removeRegex ($path) {
        // find regex in the route path
        $regex = strstr($path, '(');

        // e.g: delete /([a-z0-9_-]+) from the path
        if(!empty($regex)){
            $path = str_replace('/' . $regex, '', $path);
        }

        return $path;
    }
	
	/**
     * Get module instance function
     *
     * @param $module           Model to call
     * @param $args             Optional parameters for the model constructor
     */
	public function getModule (string $module, $args = null) {
		$module = "\App\\".$module;
		$_instance = new $module($args);

		return $_instance;
	}

	/**
     * Get debug value
     */
	public function getDebug () {
		return (bool) $this->debug;
	}

	/**
     * Get router instance
     */
	public function getRouter () {
		return $this->router;
	}

	/**
     * Get database instance
     */
	public function getDB () {
		return $this->db;
	}

	/**
     * Get twig instance
     */
	public function getTwig () {
		return $this->twig;
	}

	/**
     * Get twig loader instance
     */
	public function getTwigLoader () {
		return $this->twigLoader;
	}

	/**
     * Use GET method
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
	public function get ($pattern, $fn) {
		$this->router->get($pattern, $fn);
	}

	/**
     * Use POST method
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
	public function post ($pattern, $fn) {
		$this->router->post($pattern, $fn);
	}

    /**
     * Match function
     *
     * @param $method 		Request method
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller actionRoute function or Controller action
     */
    public function match ($method, $pattern, $fn) {
        $this->router->match($method, $pattern, $fn);
    }

    /**
     * Match all methods function
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
    public function all ($pattern, $fn) {
        $this->router->match('GET|POST|PUT|DELETE|OPTIONS|PATCH', $pattern, $fn);
    }

	/**
     * Mount function
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
	public function mount ($pattern, $fn) {
		$this->router->mount($pattern, $fn);
	}

	/**
     * Put function
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
	public function put ($pattern, $fn) {
		$this->router->put($pattern, $fn);
	}

	/**
     * Delete function
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
	public function delete ($pattern, $fn) {
		$this->router->delete($pattern, $fn);
	}

	/**
     * Options function
     *
     * @param $method 		Request method
     * @param $fn 			Route function or Controller action
     */
	public function options ($pattern, $fn) {
		$this->router->options($pattern, $fn);
	}

	/**
     * Patch function
     *
     * @param $pattern 		Pattern to match
     * @param $fn 			Route function or Controller action
     */
	public function patch ($pattern, $fn) {
		$this->router->patch($pattern, $fn);
	}

	/**
     * Before function
     *
     * @param $method 	    Request method
     * @param $pattern 	    Pattern to match
     * @param $fn 		    Route function or Controller action
     */
	public function before ($method, $pattern, $fn) {
		$this->router->before($method, $pattern, $fn);
	}
    
    /**
     * setNamespace function
     *
     * @param $namespace 	The controllers namespace
     */
	public function setNamespace ($namespace) {
		$this->router->setNamespace($namespace);
	}

	/**
     * Set 404 error function
     *
     * @param $fn 			The route function
     */
	public function set404 ($fn) {
		$this->router->set404($fn);
	}

	/**
     * Run application function
     */
	public function run ($callback = null) {
		$this->router->run($callback);
	}
	
	/**
     * Render template function using
     * @param $template     The template to render
     * @param $args         Parameter(s) passed to twig
     */
	public function render (array $template, array $args = []) {
		if (!empty($template['models'])) {
			$this->load($template['models'], $args);
		}
        
        if(!empty($this->getModule('Session\Session')->r('advert')) && !empty($template['views'])){
            $this->getTwig()->addGlobal('advert', array(
                'type' => $this->getModule('Session\Session')->r('advert', 'type'),
                'message' => $this->getModule('Session\Session')->r('advert', 'message')
            ));
            
            $this->getModule('Session\Session')->w('advert', '');
        }

		if (!empty($template['views'])) {
			echo $this->twig->render($template['views'].'.html.twig', $args);
		}
	}

	/**
     * Load router function
     * Folder /app/Resources/routers/*.php
     *
     * @param $file         Routing file to include
     * @param $args         Parameters
     */
	public function router (string $file, array $args = []) {
        $app = $this;
        
        if(file_exists($this->DIR_RESOURCES . 'routers/'.$file.'.php')){
            require_once($this->DIR_RESOURCES . 'routers/'.$file.'.php');
        }else{
            exit('Router file ' . $this->DIR_RESOURCES . 'routers/'.$file.'.php doesn\'t exist.');
        }
	}

	/**
     * Load model function
     * Folder /src/*.php
     *
     * @param $file         Model file to include
     * @param $args         Parameters
     */
	public function load (string $file, array $args = []) {
        $app = $this;
            
        if(file_exists($this->DIR_MODELS . $file . '.php')){
            require_once($this->DIR_MODELS . $file . '.php');
        }else{
            exit('Model file '.$this->DIR_MODELS . $file . '.php doesn\'t exist.');
        }
	}

	/**
     * Redirect function
	 *
	 * @param $path	        Redirection path or link
	 * @param $local	    Local redirection (true) or external link (false)
    */
	public function redirect (string $path, bool $local = true) {
		if ($local == true && $this->WEBROOT != '/') {
			header('Location:' . $this->WEBROOT . $path);
		} else {
			header('Location:' . $path);
		}
    
        exit();
	}
    
    /**
     * Return server base Path, and define it if isn't defined.
     *
     * @return string
     */
    public function getBasePath () {
        // Check if server base path is defined, if not define it.
        if ($this->serverBasePath === null) {
            $this->serverBasePath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
        }

        return $this->serverBasePath;
    }
    
    /**
     * Define the current relative URI.
     *
     * @return string
     */
	public function getURI ($array = null) {
		// Get the current Request URI and remove rewrite base path from it (= allows one to run the router in a sub folder)
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->getBasePath()));

        // Don't take query params into account on the URL
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        // Remove trailing slash + enforce a slash at the start
        $uri = '/'.trim($uri, '/');
        
        if($array === true){
            return explode('/', $uri);
        }else{
            return $uri;
        }
	}
}
