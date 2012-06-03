<?php
namespace Album;

return array(

    // Controllers in this module
    'controller' => array(
        'classes' => array(
            'album/album' => 'Album\Controller\AlbumController'
        ),
    ),

    // Routes for this module
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'album/album',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),    

    // View setup for this module
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),

    'di' => array(
        'instance' => array(
           'orm_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(
                        'Album' => array(
                            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                            'namespace' => __NAMESPACE__ . '\Entity',
                            'paths' => array(
                                __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

);
