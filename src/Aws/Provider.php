<?php

namespace App\Aws;

use Aws\Ec2\Ec2Client;
use Aws\SimpleDb\SimpleDbClient;
use Psr\Container\ContainerInterface;
use Ronanchilvers\Container\Container;
use Ronanchilvers\Container\ServiceProviderInterface;

/**
 * App service provider
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Provider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function register(Container $container)
    {
        $container->share(Ec2Client::class, function (ContainerInterface $c) {
            $settings = $c->get('settings');
            $client = new Ec2Client([
                'region'      => $settings['aws']['region'],
                'version'     => $settings['aws']['version'],
                'credentials' => $settings['aws']['credentials']
            ]);

            return $client;
        });
        $container->share(SimpleDbClient::class, function (ContainerInterface $c) {
            $settings = $c->get('settings');
            $client = new SimpleDbClient([
                // 'region'      => $settings['aws']['region'],
                'region'      => "eu-west-1",
                'version'     => $settings['aws']['version'],
                'credentials' => $settings['aws']['credentials']
            ]);

            return $client;
        });
    }
}
