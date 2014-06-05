<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarclientmessage
 */

namespace DragonJsonServerAvatarclientmessage;

/**
 * Klasse zur Initialisierung des Moduls
 */
class Module
{
    use \DragonJsonServer\ServiceManagerTrait;

    /**
     * Gibt die Konfiguration des Moduls zurück
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /**
     * Gibt die Autoloaderkonfiguration des Moduls zurück
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Wird bei der Initialisierung des Moduls aufgerufen
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
        $sharedManager = $moduleManager->getEventManager()->getSharedManager();
        $sharedManager->attach('DragonJsonServer\Service\Clientmessages', 'Clientmessages',
            function (\DragonJsonServer\Event\Clientmessages $eventClientmessages) {
                $serviceManager = $this->getServiceManager();

                $avatar = $serviceManager->get('\DragonJsonServerAvatar\Service\Avatar')
                    ->getAvatar();
                if (!isset($avatar)) {
                    return;
                }
                $avatarclientmessages = $serviceManager->get('\DragonJsonServerAvatarclientmessage\Service\Avatarclientmessage')
                    ->getAvatarclientmessagesByAvatarIdAndEventClientmessages($avatar->getAvatarId(), $eventClientmessages);
                $serviceClientmessages = $serviceManager->get('\DragonJsonServer\Service\Clientmessages');
                foreach ($avatarclientmessages as $avatarclientmessage) {
                    $serviceClientmessages->addClientmessage($avatarclientmessage->getKey(), $avatarclientmessage->getData());
                }
            }
        );
        $sharedManager->attach('DragonJsonServerAvatar\Service\Avatar', 'RemoveAvatar',
            function (\DragonJsonServerAvatar\Event\RemoveAvatar $eventRemoveAvatar) {
                $avatar = $eventRemoveAvatar->getAvatar();
                $this->getServiceManager()->get('\DragonJsonServerAvatarclientmessage\Service\Avatarclientmessage')
                    ->removeAvatarclientmessagesByAvatarId($avatar->getAvatarId());
            }
        );
    }
}
