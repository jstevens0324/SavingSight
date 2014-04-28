<?php

namespace Auth\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\Permissions\Acl\Role\GenericRole as Role;

class MyAcl extends AbstractPlugin
{

    protected $acl;
    protected $aclConfig;

    public function __construct($aclConfig)
    {
        $this->aclConfig = $aclConfig;
        $acl             = new Acl();
        //adding roles
        foreach ($this->aclConfig['roles'] as $role)
        {
            if (!empty($role['parent']))
                $acl->addRole(new Role($role['name']), $role['parent']);
            else
                $acl->addRole(new Role($role['name']));
        }

        //adding resources
        foreach ($this->aclConfig['resources'] as $resource)
        {
            $acl->addResource(new Resource($resource));
        }

        //adding permissions
        $acl->deny();
        foreach ($this->aclConfig['permissions'] as $permission)
        {
            foreach ($permission['allow'] as $role)
                $acl->allow($role, $permission['resource'], $permission['privilege']);
            foreach ($permission['deny'] as $role)
                $acl->deny($role, $permission['resource'], $permission['privilege']);
        }

        //echo '<pre>'; print_r($acl); exit;
        $this->acl = $acl;
    }

    public function checkAccess($e)
    {
        $controller      = $e->getTarget();
        $controllerClass = get_class($controller);
        $namespace       = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $routeMatch      = $e->getRouteMatch();

        $actionName     = strtolower($routeMatch->getParam('action', 'not-found')); // get the action name
        $controllerName = $routeMatch->getParam('controller', 'not-found'); // get the controller name
        $controller_val = explode('\\', $controllerName);
        $controllerName = strtolower(array_pop($controller_val));
        $user           = $this->getIdentity();
        $role           = 'guest';
        if ($user)
            $role = $user->role;
        //echo $role; exit;
        if (!$this->acl->isAllowed($role, $namespace, $controllerName . ':' . $actionName))
        {
            $router = $e->getRouter();
            if ($role == 'guest')
                $url = $router->assemble(array(), array('name' => 'auth'));
            else
                $url = $router->assemble(array(), array('name' => 'home'));
            $response = $e->getResponse();
            $response->setStatusCode(302);
            $response->getHeaders()->addHeaderLine('Location', $url);
            $e->stopPropagation();
        }
        else
        {

        }
    }

    private function getIdentity()
    {
        $authService = new \Zend\Authentication\AuthenticationService;
        return $authService->getIdentity();
    }

}
