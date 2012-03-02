<?php

namespace Test\AuthBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;

class AuthenticationFactory extends FormLoginFactory
{
    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $providerId = 'test_auth_provider.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('test_auth_provider'))
            ->replaceArgument(1, $id);
        return $providerId;
    }

    public function getKey()
    {
        return 'test_auth';
    }
}