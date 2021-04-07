<?php

namespace App\Aws;

/**
 * Class to hold region constants
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Region
{
    const ALL = [
        "af-south-1",
        "ap-east-1",
        "ap-northeast-1",
        "ap-northeast-2",
        "ap-northeast-3",
        "ap-south-1",
        "ap-south-2",
        "ap-southeast-1",
        "ap-southeast-2",
        "ap-southeast-3",
        "ca-central-1",
        "cn-north-1",
        "cn-northwest-1",
        "eu-central-1",
        "eu-central-2",
        "eu-east-1",
        "eu-north-1",
        "eu-north-1",
        "eu-south-1",
        "eu-south-1",
        "eu-west-1",
        "eu-west-2",
        "eu-west-3",
        "me-south-1",
        "me-west-1",
        "ru-central-1",
        "sa-east-1",
        "us-east-1",
        "us-east-2",
        "us-gov-east-1",
        "us-gov-secret-1",
        "us-gov-topsecret-1",
        "us-gov-west-1",
        "us-west-1",
        "us-west-2",
    ];

    const DEFAULT = [
        "eu-west-1",
        "eu-west-2",
        "us-east-1",
    ];
}
