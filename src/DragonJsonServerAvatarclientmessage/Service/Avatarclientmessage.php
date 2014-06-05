<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatar
 */

namespace DragonJsonServerAvatar\Service;

/**
 * Serviceklasse zur Verwaltung der Avatarclientmessages
 */
class Avatarclientmessage
{
	use \DragonJsonServer\ServiceManagerTrait;
	use \DragonJsonServerDoctrine\EntityManagerTrait;

	/**
	 * Erstellt eine Avatarclientmessage die dem Avatar beim nächsten Request ausgeliefert wird
     * @param integer $avatar_id
     * @param string $key
     * @param array $data
	 * @return \DragonJsonServerAvatarclientmessage\Entity\Avatarclientmessage
	 */
	public function createAvatarclientmessage($avatar_id, $key, array $data = [])
	{
        $entityManager = $this->getEntityManager();

		$avatarclientmessage = (new \DragonJsonServerAvatarclientmessage\Entity\Avatarclientmessage())
            ->setAvatarId($avatar_id)
            ->setKey($key)
            ->setData($data);
        $entityManager->persist($avatarclientmessage);
        $entityManager->flush();
		return $avatarclientmessage;
	}

    /**
     * Entfernt alle Avatarclientmessages der übergebenen AvatarId
     * @param integer $avatar_id
     * @return Avatarclientmessage
     */
    public function removeAvatarclientmessagesByAvatarId($avatar_id)
    {
        $entityManager = $this->getEntityManager();

        $avatarclientmessages = $entityManager
            ->getRepository('\DragonJsonServerAvatarclientmessage\Entity\Avatarclientmessage')
            ->findBy(['avatar_id' => $avatar_id]);
        foreach ($avatarclientmessages as $avatarclientmessage) {
            $entityManager->remove($avatarclientmessage);
        }
        $entityManager->flush();
    }

	/**
	 * Gibt die Avatarclientmessages der übergebenen AvatarId und des Clientmessage Events zurück
	 * @param integer $avatar_id
     * @param \DragonJsonServer\Event\Clientmessages $eventClientmessages
	 * @return array
	 */
	public function getAvatarclientmessagesByAvatarIdAndEventClientmessages($avatar_id,
                                                                            \DragonJsonServer\Event\Clientmessages $eventClientmessages)
	{
        $entityManager = $this->getEntityManager();

        return $entityManager
            ->createQuery('
                SELECT avatarclientmessages
                FROM \DragonJsonServerAvatarclientmessage\Entity\Avatarclientmessage avatarclientmessages
                WHERE
                    avatarclientmessages.avatar_id = :avatar_id
                    AND
                    avatarclientmessages.created >= :from
                    AND
                    avatarclientmessages.created < :to
                    AND
                    avatarclientmessages.key IN (:keys)
                ORDER BY
                    avatarclientmessages.created
            ')
            ->execute([
                'avatar_id' => $avatar_id,
                'from' => $eventClientmessages->getFrom(),
                'to' => $eventClientmessages->getTo(),
                'keys' => $eventClientmessages->getKeys(),
            ]);
	}
}
