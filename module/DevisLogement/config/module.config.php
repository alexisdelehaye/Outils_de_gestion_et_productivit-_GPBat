<?php

namespace ExportDevisTCEFromExcel;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;


return [
    'router' => [
        'routes' => [
            'ExportDevisTCEFromExcel' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/Devis[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\DevisTCEController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'Auth' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/Auth[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action'     => 'SignUp',
                    ],
                ],
            ]
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',

        ],
    ],

    'controllers' => [
            'factories' => [
                Controller\DevisTCEController::class => function($container) {
                    return new Controller\DevisTCEController(
                        $container->get(Models\devisTCETable::class)
                    );
                },

            ],
        ],



];


