<?php
namespace LaCagnaUser;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        // Adding translators
        $translator = $e->getApplication()->getServiceManager()->get('translator');

        // ZfcUser translator
        $translator->addTranslationFile(
        'gettext',
        'vendor/zf-commons/zfc-user/src/ZfcUser/language/fr_FR.mo',
        'default',
        'fr_FR'
        );

        \Zend\Validator\AbstractValidator::setDefaultTranslator(new \Zend\Mvc\I18n\Translator($translator));
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
