<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'zfcuser' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'LaCagnaUser\Controller\Bookmark' => 'LaCagnaUser\Controller\BookmarkController',
        ),
    ),
    'router' => array(
        'routes' => array(
          'tooglebookmark' => array(
              'type' => 'Segment',
              'options' => array(
                  'route'    => '/user/bookmark[/:productId]',
                  'defaults' => array(
                      'controller' => 'LaCagnaUser\Controller\Bookmark',
                      'action'     => 'toggle',
                  ),
              ),
          ),
          'mybookmarks' => array(
              'type' => 'Segment',
              'options' => array(
                  'route'    => '/user/mybookmarks',
                  'defaults' => array(
                      'controller' => 'LaCagnaUser\Controller\Bookmark',
                      'action'     => 'mybookmarks',
                  ),
              ),
          ),
      ),
    ),
    'doctrine' => array(
        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/LaCagnaUser/Entity',
            ),

            'orm_default' => array(
                'drivers' => array(
                    'LaCagnaUser\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
    ),

    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'LaCagnaUser\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
    ),

    'service_manager' => array(

        'factories' => array(
            'bookmark'        => 'LaCagnaUser\Factory\BookmarkFactory',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'bookmark' => 'LaCagnaUser\View\Helper\Bookmark',

        )
    ),

    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',

        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'product' => array(),
            ),
        ),
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    //          role
                    array(array('administrator'), 'product', array('list', 'add')),
                ),
            ),
        ),
        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'LaCagnaUser\Entity\Role',
            ),
        ),
    ),
);
