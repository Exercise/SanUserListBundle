<?php

namespace San\UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SanUserExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $container->setParameter(sprintf("%s.manager", $this->getAlias()), $config['manager']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('form.xml');
        $loader->load('admin.xml');

        // Set manager
        $userAdmin = $container->getDefinition('san.admin.user');
        $userAdminTag = $userAdmin->getTag('sonata.admin');
        $userAdminTag[0]['manager_type'] = $config['manager'];
        $userAdmin->setTags(array('sonata.admin' => $userAdminTag));

        // Set model
        if ($config['manager'] == 'orm') {
            $model = $userAdmin->getArgument(1);
            $userAdmin->replaceArgument(1, str_replace('Document', 'Entity', $model));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'san_user';
    }
}
