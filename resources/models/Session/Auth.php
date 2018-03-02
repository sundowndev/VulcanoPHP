<?php

namespace App\Session;

use App\Application;
use App\Validator\Validator;
use App\Session\Session;

class Auth extends Application
{
    public static function isLogged ()
    {
        if (empty(Session::r('auth')) || Session::r('auth') === false)
        {
            return false;
        }else{
            return true;
        }
    }

    public static function isAdmin ()
    {
        if (!self::isLogged() || Session::r('access') !== 1)
        {
            return false;
        }else{
            return true;
        }
    }

    public static function getCSRF ()
    {
        return Session::getCSRF();
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
        Session::w('auth', true);
        Session::w('id', $session['id']);
        Session::w('hash_id', $session['hash_id']);
        Session::w('username', $session['username']);
        Session::w('email', $session['email']);
        Session::w('access', $session['access']);
        Session::setCSRF();
    }

    public static function logout (string $csrf, Application $app)
    {
        if(self::isLogged() && $csrf == self::getCSRF())
        {
            Session::w('auth', false);
            Session::destroy();
            $app->redirect($app->config['paths']['admin']);
        } else {
            $app->ErrorAction();
        }
    }
}