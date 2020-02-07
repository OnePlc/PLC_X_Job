<?php
/**
 * Module.php - Module Class
 *
 * Module Class File for Job Module
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

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Mvc\MvcEvent;
use Laminas\ModuleManager\ModuleManager;
use Laminas\Session\Config\StandardConfig;
use Laminas\Session\SessionManager;
use Laminas\Session\Container;
use Application\Controller\CoreEntityController;
use OnePlace\Job\Controller\PluginController;

class Module {
    /**
     * Module Version
     *
     * @since 1.0.0
     */
    const VERSION = '1.0.0';

    /**
     * Load module config file
     *
     * @since 1.0.0
     * @return array
     */
    public function getConfig() : array {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Load Models
     */
    public function getServiceConfig() : array {
        return [
            'factories' => [
                # Job Module - Base Model
                Model\JobTable::class => function($container) {
                    $tableGateway = $container->get(Model\JobTableGateway::class);
                    return new Model\JobTable($tableGateway,$container);
                },
                Model\JobTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Job($dbAdapter));
                    return new TableGateway('job', $dbAdapter, null, $resultSetPrototype);
                },
                # Job Module - Position Model
                Model\PositionTable::class => function($container) {
                    $tableGateway = $container->get(Model\PositionTableGateway::class);
                    return new Model\PositionJobTable($tableGateway,$container);
                },
                Model\PositionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Position($dbAdapter));
                    return new TableGateway('jobposition', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    /**
     * Load Controllers
     */
    public function getControllerConfig() : array {
        return [
            'factories' => [
                # Plugin Example Controller
                Controller\PluginController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\PluginController(
                        $oDbAdapter,
                        $container->get(Model\JobTable::class),
                        $container
                    );
                },
                # Job Main Controller
                Controller\JobController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    $tableGateway = $container->get(Model\JobTable::class);
                    # hook plugin
                    return new Controller\JobController(
                        $oDbAdapter,
                        $container->get(Model\JobTable::class),
                        $container
                    );
                },
                # Api Plugin
                Controller\ApiController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\ApiController(
                        $oDbAdapter,
                        $container->get(Model\JobTable::class),
                        $container
                    );
                },
                # Job Position Controller
                Controller\PositionController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\PositionController(
                        $oDbAdapter,
                        $container->get(Model\PositionTable::class),
                        $container
                    );
                },
                # Api Position Plugin
                Controller\ApiPositionController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\ApiPositionController(
                        $oDbAdapter,
                        $container->get(Model\PositionTable::class),
                        $container
                    );
                },
                # Export Plugin
                Controller\ExportController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\ExportController(
                        $oDbAdapter,
                        $container->get(Model\JobTable::class),
                        $container
                    );
                },
                # Search Plugin
                Controller\SearchController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\SearchController(
                        $oDbAdapter,
                        $container->get(Model\JobTable::class),
                        $container
                    );
                },
            ],
        ];
    }
}
