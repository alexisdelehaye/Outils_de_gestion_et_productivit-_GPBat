<?php

namespace ExportDevisTCEFromExcel;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Authentication\AuthenticationService;
use ExportDevisTCEFromExcel\Controller\DevisTCEController;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [

                Models\devisTCETable::class => function($container) {
                    $tableGateway = $container->get(Models\DevisTCETableGateway::class);
                    return new Models\devisTCETable($tableGateway);
                },
                Models\DevisTCETableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Models\DevisTCE());
                    return new TableGateway('ExportDevisTCEFromExcel', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                DevisTCEController::class => function($container) {
                    return new DevisTCEController(
                        $container->get(Models\devisTCETable::class)

                    );
                },
            ],
        ];
    }


}