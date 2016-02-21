<?php
namespace LaCagnaAdviseMe;

use Zend\Console\Adapter\AdapterInterface as Console;


class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
    * Load usage configuration of console
    */
    public function getConsoleUsage(Console $console)
    {
        return include __DIR__ . '/config/consoleusage.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
