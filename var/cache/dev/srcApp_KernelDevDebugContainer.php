<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerLmiiNgZ\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerLmiiNgZ/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerLmiiNgZ.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerLmiiNgZ\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerLmiiNgZ\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'LmiiNgZ',
    'container.build_id' => '9abf6039',
    'container.build_time' => 1565464737,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerLmiiNgZ');
