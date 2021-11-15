<?php

namespace App\Queue;

use App\Aws\Discovery\Ec2Handler;
use App\Aws\Discovery\S3Handler;
use App\Aws\Model\Account;
use App\Facades\Log;
use App\Model\State;
use Aws\Ec2\Ec2Client;
use Aws\S3\S3Client;
use Ronanchilvers\Foundation\Queue\Job\Job;

class DiscoverJob extends Job
{
    protected $queue = 'discover';

    protected $account = null;

    public function __construct($account)
    {
        $this->account = $account;
    }

    public function execute()
    {
        if (!$this->account instanceof Account) {
            throw new \Exception('Invalid account id');
        }
        $regions = $this->account->regions;
        Log::info("Discovery starting", [
            'account' => $this->account->id,
            'regions' => $regions,
        ]);
        State::put('discover', 'active');
        foreach ($regions as $region) {
            sleep(2);
            Log::info("Region {$region}", [
                'account' => $this->account->id,
                'regions' => $regions,
            ]);
            try {
                Log::debug("Discovering EC2 resources", [
                    'account' => $this->account->id,
                    'region' => $region,
                ]);
                $client = new Ec2Client([
                    'version' => 'latest',
                    'region' => $region,
                    'credentials' => $this->account->getCredentialsArray()
                ]);
                $ec2 = new Ec2Handler(
                    $client,
                    $this->account
                );
                $ec2->discover();

                Log::debug("Discovering S3 resources", [
                    'account' => $this->account->id,
                    'region' => $region,
                ]);
                $client = new S3Client([
                    'version' => 'latest',
                    'region' => $region,
                    'credentials' => $this->account->getCredentialsArray()
                ]);
                $s3 = new S3Handler(
                    $client,
                    $this->account
                );
                $s3->discover();
            } catch (\Exception $ex) {
                Log::error($ex->getMessage(), [
                    'exception' => $ex,
                ]);
            }
        }
        Log::info("Discovery complete", [
            'account' => $this->account->id,
        ]);
        State::put('discover', 'inactive');
    }
}
