<?php
/**
 * module.config.php - Job Config
 *
 * Main Config File for Job Module
 *
 * @category Config
 * @package Job
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Job;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    # Job Module - Routes
    'router' => [
        'routes' => [
            # Module Basic Route
            'job' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/job[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\JobController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'job-api' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/job/api[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    # View Settings
    'view_manager' => [
        'template_path_stack' => [
            'job' => __DIR__ . '/../view',
        ],
    ],
];
