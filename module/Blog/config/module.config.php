<?php
return array(
		      'service_manager' => array(
		      		'invokables' => array(
		      				'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
		      		),
				'factories' => array(
						'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory'
				)
		),
    'controllers' => array(
    		
        'invokables' => array(
            'Blog\Controller\Blog' => 'Blog\Controller\BlogController',
        		'Blog\Controller\List' => 'Blog\Controller\ListController'
        )
    ),
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/blog[/:action][/:id]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Blog\Controller',
                        'controller'    => 'Blog',
                        'action'        => 'foo',
                    ),
                		
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        		'list' => array(
        				'type'    => 'Literal',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/blog/list',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Blog\Controller',
        								'controller'    => 'List',
        								'action'        => 'index',
        						),
        				),
        				),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Blog' => __DIR__ . '/../view',
        ),
    ),
);
