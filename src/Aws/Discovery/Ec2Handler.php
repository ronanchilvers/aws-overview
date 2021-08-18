<?php

namespace App\Aws\Discovery;

use App\Aws\Discovery\Handler;
use App\Aws\Model\Resource;
use Exception;
use Ronanchilvers\Orm\Orm;

/**
 * Handler class for EC2 resources
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Ec2Handler extends Handler
{
    /**
     * Discover resources
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function discover()
    {
        $result = $this->client()->describeInstances();
        foreach ($result['Reservations'] as $reservation) {
            foreach ($reservation["Instances"] as $instance) {
                $region     = $this->client()->getRegion();
                $account    = $this->account();
                $instanceId = $instance["InstanceId"];
                $arn        = sprintf(
                    "arn:aws:ec2:%s:%s:instance/%s",
                    $region,
                    $account->number,
                    $instanceId
                );
                $finder = Orm::finder(Resource::class);
                $existing = $finder
                                ->select()
                                ->where(Resource::prefix('arn'), $arn)
                                ->one();
                if ($existing instanceof Resource) {
                    $existing->save(); // Update the record timestamp
                    continue;
                }
                $name = '';
                foreach ($instance["Tags"] as $tag) {
                    if ("Name" == $tag["Key"]) {
                        $name = $tag["Value"];
                    }
                }
                $resource          = new Resource;
                $resource->account = $account;
                $resource->arn     = $arn;
                $resource->region  = $this->client()->getRegion();
                $resource->name    = empty($name) ? $instanceId : $name;
                $resource->state   = $instance["State"]["Name"];
                if (!$resource->saveWithValidation()) {
                    throw new Exception('Unable to save resource');
                }
            }
        }
    }
}
