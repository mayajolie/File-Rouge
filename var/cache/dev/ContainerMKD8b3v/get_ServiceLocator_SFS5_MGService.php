<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.sFS5.mG' shared service.

return $this->privates['.service_locator.sFS5.mG'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
    'serializer' => ['services', 'serializer', 'getSerializerService', false],
    'user' => ['privates', '.errored..service_locator.sFS5.mG.App\\Entity\\User', NULL, 'Cannot autowire service ".service_locator.sFS5.mG": it references class "App\\Entity\\User" but no such service exists.'],
    'validator' => ['services', 'validator', 'getValidatorService', false],
], [
    'entityManager' => '?',
    'serializer' => '?',
    'user' => 'App\\Entity\\User',
    'validator' => '?',
]);