<?php

namespace Controllers\Admin;

//use \App\Application as Application;

class Controller {
    
    /**
     * Get module instance
     */
	public function getModule (string $module) {
		$module = "\App\\".$module;
		$_instance = new $module();
		return $_instance;
	}
    
    /**
     * Redirect function
	 *
	 * @param $local	choose local redirection or external link
    */
	public function redirect (string $path, bool $local = true) {
		if ($local == true) {
			header('Location:'.$this->domain.$path);
		} else {
			header('Location:'.$path);
		}
	}
    
    public function logoutAction($token) {
        if($this->getModule('Session\Session')->r('auth') === true && $token == $this->getModule('Session\Session')->getCSRF()){
            $this->getModule('Session\Session')->w('auth', false);
            $this->redirect('/');
        } else {
            $this->redirect('/404');
        }
    }
}