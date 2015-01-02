<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Blog for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog;

use Blog\Model\Poem;
use Blog\Model\PoemTable;
use Blog\Model\Author;
use Blog\Model\AuthorTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Blog\Model\PoemTable' =>  function($sm) {
                     $tableGateway = $sm->get('PoemTableGateway');
                     $table = new PoemTable($tableGateway);
                     return $table;
                 },
                 'PoemTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Poem());
                     return new TableGateway('Poem', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Blog\Model\AuthorTable' =>  function($sm) {
                 	$tableGateway = $sm->get('AuthorTableGateway');
                 	$table = new AuthorTable($tableGateway);
                 	return $table;
                 },
                 'AuthorTableGateway' => function ($sm) {
                 	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                 	$resultSetPrototype = new ResultSet();
                 	$resultSetPrototype->setArrayObjectPrototype(new Author());
                 	return new TableGateway('Author', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
     
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
