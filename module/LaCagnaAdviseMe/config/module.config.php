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
