<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarclientmessage
 */

namespace DragonJsonServerAvatarclientmessage\Entity;

/**
 * Entityklasse einer Avatarclientmessage
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="avatarclientmessages")
 */
class Avatarclientmessage
{
	use \DragonJsonServerDoctrine\Entity\CreatedTrait;
    use \DragonJsonServerAvatar\Entity\AvatarIdTrait;
	
	/** 
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $avatarclientmessage_id;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     **/
    protected $key;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     **/
    protected $data;
	
	/**
	 * Setzt die ID der Avatarclientmessage
	 * @param integer $avatarclientmessage_id
	 * @return Avatarclientmessage
	 */
	protected function setAvatarclientmessageId($avatarclientmessage_id)
	{
		$this->avatarclientmessage_id = $avatarclientmessage_id;
		return $this;
	}
	
	/**
	 * Gibt die ID der Avatarclientmessage zurück
	 * @return integer
	 */
	public function getAvatarclientmessageId()
	{
		return $this->avatarclientmessage_id;
	}

    /**
     * Setzt den Key der Avatarclientmessage
     * @param string $key
     * @return Avatarclientmessage
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Gibt den Key der Avatarclientmessage zurück
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Setzt die Daten der Avatarclientmessage
     * @param array $data
     * @return Avatarclientmessage
     */
    public function setData(array $data)
    {
        $this->data = \Zend\Json\Encoder::encode($data);
        return $this;
    }

    /**
     * Gibt die Daten der Avatarclientmessage zurück
     * @return array
     */
    public function getData()
    {
        return \Zend\Json\Decoder::decode($this->data, \Zend\Json\Json::TYPE_ARRAY);
    }
	
	/**
	 * Setzt die Attribute der Avatarclientmessage aus dem Array
	 * @param array $array
	 * @return Avatarclientmessage
	 */
	public function fromArray(array $array)
	{
		return $this
            ->setAvatarclientmessageId($array['avatarclientmessage_id'])
            ->setCreatedTimestamp($array['created'])
            ->setAvatarId($array['avatar_id'])
            ->setKey($array['key'])
            ->setData($array['data']);
	}
	
	/**
	 * Gibt die Attribute der Avatarclientmessage als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'__className' => __CLASS__,
			'avatarclientmessage_id' => $this->getAvatarclientmessageId(),
            'created' => $this->getCreatedTimestamp(),
            'avatar_id' => $this->getAvatarId(),
            'key' => $this->getKey(),
            'data' => $this->getData(),
		];
	}
}
