<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerUDmeaNp\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerUDmeaNp/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerUDmeaNp.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerUDmeaNp\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerUDmeaNp\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'UDmeaNp',
    'container.build_id' => 'e7e79dfe',
    'container.build_time' => 1565358583,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerUDmeaNp');
