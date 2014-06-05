<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarclientmessage
 */

/**
 * @return array
 */
return [
	'service_manager' => [
		'invokables' => [
            '\DragonJsonServerAvatarclientmessage\Service\Avatarclientmessage' => '\DragonJsonServerAvatarclientmessage\Service\Avatarclientmessage',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAvatarclientmessage_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAvatarclientmessage/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAvatarclientmessage\Entity' => 'DragonJsonServerAvatarclientmessage_driver'
				],
			],
		],
	],
];
