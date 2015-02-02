<?php
namespace LaCagnaContent;
return array(
    'controllers' => array(
        'invokables' => array(
            'LaCagnaContent\Controller\Admin' => 'LaCagnaContent\Controller\AdminController',
        ),
    ),
    'service_manager' => array(
        'shared' => array(
            // Usually, you'll only indicate services that should _NOT_ be
            // shared -- i.e., ones where you want a different instance
            // every time.
        ),
        'factories' => array(
            'navigation'        => 'LaCagnaContent\Factory\NavigationFactory',
            'adminNavigation'   => 'LaCagnaContent\Factory\AdminNavigationFactory',            
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'extension' => '.dcm.yml',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Mapping')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
        'configuration' => array(
            'orm_default' => array(
                'proxy_dir' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Proxy',
                'proxy_namespace' => __NAMESPACE__ .'\Proxy',
            ),
        ),
    ),
);
