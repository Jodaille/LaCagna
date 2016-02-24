<?php
namespace LaCagnaAdviseMe;

return array(
    'controllers' => array(
        'invokables' => array(
            'LaCagnaAdviseMe\Controller\AdviseMe' => 'LaCagnaAdviseMe\Controller\AdviseMeController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'advise'        => 'LaCagnaAdviseMe\Factory\AdviseMeFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            //getadvise
            'getadvise' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/getadvise',
                    'defaults' => array(
                        'controller' => 'LaCagnaAdviseMe\Controller\AdviseMe',
                        'action'     => 'getadvise',
                    ),
                ),
            ),
            'adviseme' => array(
              'type' => 'Segment',
              'options' => array(
                  'route'    => '/adviseme',
                  'defaults' => array(
                      'controller' => 'LaCagnaAdviseMe\Controller\AdviseMe',
                      'action'     => 'index',
                  ),
              ),
            ),
      ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'advise' => array(
                    'options' => array(
                        'route'    => 'advise [--verbose|-v] [<userId>]',
                        'defaults' => array(
                            'controller' => 'LaCagnaAdviseMe\Controller\AdviseMe',
                            'action'     => 'bestAdvice'
                        )
                    )
                ),
            ),
        ),
    ),
);
