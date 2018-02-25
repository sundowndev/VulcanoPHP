<?php

namespace App\Session;

use App\Application;
use App\Validator\Validator;

class Auth extends Application
{
    public static function isLogged ()
    {
        if (empty($app->getModule('Session\Session')->r('auth')) || $app->getModule('Session\Session')->r('auth') === false)
        {
            return false;
        }else{
            return true;
        }
    }
    
    public static function getCSRF ()
    {
        if (!empty($app->getModule('Session\Session')->getCSRF()))
        {
            return $app->getModule('Session\Session')->getCSRF();
        }else{
            return null;
        }
    }
    
    public static function login (string $username, string $password, Application $app)
    {
        if(!empty($username) && !empty($password))
        {
            $app->getDB()->query('SELECT * FROM d_users WHERE username = :name');
            $app->getDB()->bind(':name', $username);
            $app->getDB()->execute();

            $target = $app->getDB()->single();

            if($target && $app->getModule('Secure\Secure')->verifyHash($password, $target['password']))
            {
                self::createSession($target, $app);

                if(!empty($_GET['redirect']))
                {
                    $app->redirect($_GET['redirect']);
                }else{
                    $app->redirect($app->config['paths']['admin'].'/dashboard');
                }
            }else{
                $app->getModule('Session\Advert')->setAdvert('error', 'Bad username or password');
            }
        }
    }

    public static function createSession (array $session, Application $app)
    {
        $app->getModule('Session\Session')->w('auth', true);
        $app->getModule('Session\Session')->w('id', $session['id']);
        $app->getModule('Session\Session')->w('hash_id', $session['hash_id']);
        $app->getModule('Session\Session')->w('username', $session['username']);
        $app->getModule('Session\Session')->w('email', $session['email']);
        $app->getModule('Session\Session')->setCSRF();
    }

    public static function logout (string $csrf, Application $app)
    {
        if(self::isLogged() && $csrf == self::getCSRF())
        {
            $app->getModule('Session\Session')->w('auth', false);
            $app->getModule('Session\Session')->destroy();
            $app->redirect($app->config['paths']['admin']);
        } else {
            $app->ErrorAction();
        }
    }
}

?>
