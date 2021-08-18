<?php

namespace App\Aws\Discovery;

use App\Aws\Model\Account;
use Aws\AwsClient;

/**
 * Base handler class for AWS resource discovery
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
abstract class Handler
{
    /**
     * @var Aws\AwsClient
     */
    private $client;

    /**
     * @var App\Aws\Model\Account
     */
    private $account;

    /**
     * Class constructor
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __construct(
        AwsClient $client,
        Account $account
    ) {
        $this->client = $client;
        $this->account = $account;
    }

    /**
     * Get the client object
     *
     * @return Aws\AwsClient
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function client(): AwsClient
    {
        return $this->client;
    }

    /**
     * Get the account object
     *
     * @return App\Aws\Model\Account
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function account(): Account
    {
        return $this->account;
    }

    /**
     * Discover resources
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    abstract public function discover();
}
