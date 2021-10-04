<?php

namespace App\DependencyInjection\CompilerPass;

use App\Services\Notification\NotificationContext;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class NotificationCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $notification = $container->findDefinition(NotificationContext::class);

        $strategyHandlers = array_keys($container->findTaggedServiceIds('notification_service'));

        foreach ($strategyHandlers as $handler) {
            $notification->addMethodCall('setStrategy', [new Reference($handler)]);
        }
    }
}