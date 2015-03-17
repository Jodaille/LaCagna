<?php
namespace LaCagnaProduct;

$display_errors = false;
$app_env = getenv('APPLICATION_ENV');
if($app_env == 'development')
{
  $display_errors = true;
}

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
            'LaCagnaProduct\Controller\Product' => 'LaCagnaProduct\Controller\ProductController',
            'LaCagnaProduct\Controller\Admin' => 'LaCagnaProduct\Controller\AdminController',
            'LaCagnaProduct\Controller\Media' => 'LaCagnaProduct\Controller\MediaController',
            'LaCagnaProduct\Controller\PaperMenu' => 'LaCagnaProduct\Controller\PaperMenuController',

        ),
    ),
    'service_manager' => array(
        'shared' => array(
            // Usually, you'll only indicate services that should _NOT_ be
            // shared -- i.e., ones where you want a different instance
            // every time.
        ),
        'factories' => array(
            'navigation'        => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'ProductsListing'   => 'LaCagnaProduct\Factory\ProductsListingFactory',
            'Categories'        => 'LaCagnaProduct\Factory\CategoriesFactory',
            'Products'          => 'LaCagnaProduct\Factory\ProductsFactory',
            'ProductManager'    => 'LaCagnaProduct\Factory\ProductManager',
        ),
        'invokables' => array(
          'ImagineGd'      => 'Imagine\Gd\Imagine',
          'ImagineImagick' => 'Imagine\Imagick\Imagine',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'thumb' => 'LaCagnaProduct\View\Helper\Thumb',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => $display_errors,
        'display_exceptions'       => $display_errors,
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
    'console' => array(
        'router' => array(
            'routes' => array(
                'create-root' => array(
                    'options' => array(
                        'route'    => 'create root [--verbose|-v] <categoryTitle>',
                        'defaults' => array(
                            'controller' => 'LaCagnaProduct\Controller\Admin',
                            'action'     => 'createroot'
                        )
                    )
                ),
                'addcategory' => array(
                    'options' => array(
                        'route'    => 'addcategory <title>',
                        'defaults' => array(
                            'controller' => 'LaCagnaProduct\Controller\Admin',
                            'action'     => 'addcategory'
                        )
                    )
                ),
                'parentcategory' => array(
                    'options' => array(
                        'route'    => 'parentcategory <category_id> <parent_id>',
                        'defaults' => array(
                            'controller' => 'LaCagnaProduct\Controller\Admin',
                            'action'     => 'parentcategory'
                        )
                    )
                ),
            )
        )
    ),
    'router' => array(
        'routes' => array(
          'adminindex' => array(
              'type' => 'Segment',
              'options' => array(
                  'route'    => '/gestion[/]',
                  'defaults' => array(
                      'controller' => 'LaCagnaProduct\Controller\Admin',
                      'action'     => 'index',
                  ),
              ),
          ),
          'papermenupdf' => array(
              'type' => 'Zend\Mvc\Router\Http\Literal',
              'options' => array(
                  'route'    => '/gestion/menupdf',
                  'defaults' => array(
                      'controller' => 'LaCagnaProduct\Controller\PaperMenu',
                      'action'     => 'generatepdf',
                  ),
              ),
          ),
          'fetchimage' => array(
              'type' => 'Zend\Mvc\Router\Http\Literal',
              'options' => array(
                  'route'    => '/gestion/fetchimage',
                  'defaults' => array(
                      'controller' => 'LaCagnaProduct\Controller\Media',
                      'action'     => 'fetchimage',
                  ),
              ),
          ),
          'thumbnail' => array(
              'type'    => 'Segment',
              'options' => array(
                  'route'    => '/img[/:format][/:image]',
                  'constraints' => array(
                      'image'          => '([a-zA-Z0-9_.-]*?)\.(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF)',
                      'format'         => '[a-zA-Z0-9_-]*',
                  ),
                  'defaults' => array(
                       '__NAMESPACE__' => 'LaCagnaProduct\Controller',
                       'controller'    => 'Media',
                       'action'        => 'thumb',
                  ),
              ),
          ),

          'parentcategories' => array(
              'type' => 'Segment',
              'options' => array(
                  'route'    => '/gestion/parentcategories[/]',

                  'defaults' => array(
                      'controller' => 'LaCagnaProduct\Controller\Admin',
                      'action'     => 'parentcategories',
                  ),
              ),
          ),
          'adminproductsCategory' => array(
              'type' => 'Segment',
              'options' => array(
                  'route'    => '/gestion/productscategory[/][/:id[/]]',
                  'constraints' => array(
                      'id'    => '[0-9]+',
                  ),
                  'defaults' => array(
                      'controller' => 'LaCagnaProduct\Controller\Admin',
                      'action'     => 'productsCategory',
                  ),
              ),
          ),
            'admincategorieslist' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/gestion/categories',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'categorylisting',
                    ),
                ),
            ),
            'admineditcategory' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/gestion/edition/category[/][/:id[/]]',
                    'constraints' => array(
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'editcategory',
                    ),
                ),
            ),
            'admineditingredient' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/gestion/edition/ingredient[/][/:id[/]]',
                    'constraints' => array(
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'editingredient',
                    ),
                ),
            ),
            'ingredientslisting' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/gestion/ingredients',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'ingredientslisting',
                    ),
                ),
            ),
            'adminproductslist' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/gestion/produits',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'productlisting',
                    ),
                ),
            ),
            'admineditproduct' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/gestion/edition/produit[/][/:id[/]]',
                    'constraints' => array(
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'editproduct',
                    ),
                ),
            ),
            'admineditarticles' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/gestion/edition/articles[/][/:id[/]]',
                    'constraints' => array(
                        'id'    => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'editarticles',
                    ),
                ),
            ),
            'qrcode' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/gestion/flashme',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Admin',
                        'action'     => 'qrcode',
                    ),
                ),
            ),
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
            'aperitifs' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/aperitifs',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'apéritifs',
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
            'softs' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/softs',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'soft',
                    ),
                ),
            ),
            'vins' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/vins',
                    'defaults' => array(
                        'controller' => 'LaCagnaProduct\Controller\Product',
                        'action'     => 'bytype',
                        'type'       => 'vins',
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
