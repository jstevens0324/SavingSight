<?php

namespace Auth;

use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('route', array(
            $this,
            'attachAcl'
        ), 2);
    }

    public function attachAcl(MvcEvent $e)
    {
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        $sharedManager = $application->getEventManager()->getSharedManager();

        $router = $sm->get('router');
        $request = $sm->get('request');

        $matchedRoute = $router->match($request);
        if (NULL !== $matchedRoute)
        {
            $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function ($e) use ($sm)
                {
                    $sm->get('Acl')->checkAccess($e);
                }, 2
            );
        }
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Acl' => function ($sm)
                    {
                        $config = $sm->get('Config');
                        $acl = new \Auth\Plugin\MyAcl($config['acl']);
                        return $acl;
                    }
            ),
        );
    }

}