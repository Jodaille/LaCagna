<?php
namespace LaCagnaProduct;
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Bières',
                'route' => 'bieres',
                'pages' => array(
                    array(
                        'label' => 'Ajouter',
                        'route' => 'addproduct',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Add',
                        'route' => 'addproduct',
                        'action' => 'add',
                    ),
                ),
            ),
            array(
                'label' => 'Cocktails',
                'route' => 'cocktails',
            ),
            array(
                'label' => 'Shooters',
                'route' => 'shooters',
            ),
            array(
                'label' => 'Jus',
                'route' => 'jus',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'LaCagnaProduct\Controller\Product' => 'LaCagnaProduct\Controller\ProductController'
        ),
    ),
    'service_manager' => array(
        'shared' => array(
            // Usually, you'll only indicate services that should _NOT_ be
            // shared -- i.e., ones where you want a different instance
            // every time.
        ),
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'ProductsListing' => 'LaCagnaProduct\Factory\ProductsListingFactory',
            'Categories' => 'LaCagnaProduct\Factory\CategoriesFactory',
            'ProductManager' => 'LaCagnaProduct\Factory\ProductManager',


        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/la-cagna-product/product/index.twig',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'addproduct' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/addproduct',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'add',
                    ),
                ),
            ),
            'bieres' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/bieres',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'biere',
                    ),
                ),
            ),
            'cocktails' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/cocktails',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'cocktail',
                    ),
                ),
            ),
            'shooters' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/shooters',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'shooter',
                    ),
                ),
            ),
            'jus' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/jus',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'jus',
                    ),
                ),
            ),
        ),
	),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
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
