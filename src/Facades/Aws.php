<?php

namespace App\Facades;

use Aws\Ec2\Ec2Client;
use Aws\SimpleDb\SimpleDbClient;
use Psr\Log\LoggerInterface;
use Ronanchilvers\Foundation\Facade\Facade;

/**
 * Session facade class
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Aws extends Facade
{
    static protected $services = [
        "ec2" => Ec2Client::class,
        "sdb" => SimpleDbClient::class,
    ];

    public static function __callStatic($method, $args)
    {
        $method = strtolower($method);
        if (array_key_exists($method, static::$services)) {
            return self::getContainer()->get(static::$services[$method]);
        }
    }
}
