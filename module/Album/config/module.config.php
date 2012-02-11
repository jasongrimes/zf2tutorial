<?php

namespace Album;

return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'album' => 'Album\Controller\AlbumController',
            ),
            'Album\Controller\AlbumController' => array(
                'parameters' => array(
                    // 'albumTable' => 'Album\Model\AlbumTable',
                    'em' => 'doctrine_em',
                ),
            ),
            'Album\Model\AlbumTable' => array(
                'parameters' => array(
                    'config' => 'Zend\Db\Adapter\Mysqli',
                ),
            ),
            'Zend\Db\Adapter\Mysqli' => array(
                'parameters' => array(
                    'config' => array(
                        'host' => 'localhost',
                        'username' => 'root',
                        'password' => 'dev',
                        'dbname' => 'zftutorial',
                    ),
                ),
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'options'  => array(
                        'script_paths' => array(
                            'album' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
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