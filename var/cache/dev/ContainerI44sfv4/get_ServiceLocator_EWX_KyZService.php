<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.EWX.KyZ' shared service.

return $this->privates['.service_locator.EWX.KyZ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'transaction' => ['privates', '.errored..service_locator.EWX.KyZ.App\\Entity\\Transaction', NULL, 'Cannot autowire service ".service_locator.EWX.KyZ": it references class "App\\Entity\\Transaction" but no such service exists.'],
], [
    'transaction' => 'App\\Entity\\Transaction',
]);