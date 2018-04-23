<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/auth')) {
                // authsignin
                if ('/auth' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'App\\Components\\FrontOffice\\Controller\\AuthController::signinAction',  '_route' => 'authsignin',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not_authsignin;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', 'authsignin'));
                    }

                    if (!in_array($canonicalMethod, array('GET'))) {
                        $allow = array_merge($allow, array('GET'));
                        goto not_authsignin;
                    }

                    return $ret;
                }
                not_authsignin:

                // authsigninPost
                if ('/auth/' === $pathinfo) {
                    $ret = array (  '_controller' => 'App\\Components\\FrontOffice\\Controller\\AuthController::signinPostAction',  '_route' => 'authsigninPost',);
                    if (!in_array($requestMethod, array('POST'))) {
                        $allow = array_merge($allow, array('POST'));
                        goto not_authsigninPost;
                    }

                    return $ret;
                }
                not_authsigninPost:

            }

            // single_article
            if (0 === strpos($pathinfo, '/article') && preg_match('#^/article/(?P<slug>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'single_article')), array (  '_controller' => 'App\\Components\\FrontOffice\\Controller\\DefaultController::single_article',));
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_single_article;
                }

                return $ret;
            }
            not_single_article:

            // adminindex
            if ('/admin' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'App\\Components\\BackOffice\\Controller\\AdminController::index',  '_route' => 'adminindex',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_adminindex;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'adminindex'));
                }

                return $ret;
            }
            not_adminindex:

        }

        // index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'App\\Components\\FrontOffice\\Controller\\DefaultController::index',  '_route' => 'index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'index'));
            }

            if (!in_array($canonicalMethod, array('GET'))) {
                $allow = array_merge($allow, array('GET'));
                goto not_index;
            }

            return $ret;
        }
        not_index:

        // single_category
        if (0 === strpos($pathinfo, '/category') && preg_match('#^/category/(?P<slug>[^/]++)$#sD', $pathinfo, $matches)) {
            $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'single_category')), array (  '_controller' => 'App\\Components\\FrontOffice\\Controller\\DefaultController::single_category',));
            if (!in_array($canonicalMethod, array('GET'))) {
                $allow = array_merge($allow, array('GET'));
                goto not_single_category;
            }

            return $ret;
        }
        not_single_category:

        // _twig_error_test
        if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
