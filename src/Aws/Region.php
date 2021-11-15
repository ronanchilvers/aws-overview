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
        "af-south-1"         => "Africa (Cape Town)",
        "ap-east-1"          => "Asia Pacific (Hong Kong) SAR",
        "ap-northeast-1"     => "Asia Pacific (Tokyo)",
        "ap-northeast-2"     => "Asia Pacific (Seoul)",
        "ap-northeast-3"     => "Asia Pacific (Osaka-Local)",
        "ap-south-1"         => "Asia Pacific (Mumbai) ",
        "ap-southeast-1"     => "Asia Pacific (Singapore)",
        "ap-southeast-2"     => "Asia Pacific (Sydney)",
        "ca-central-1"       => "Canada (Montreal) ",
        "cn-north-1"         => "China (Beijing) ",
        "cn-northwest-1"     => "China (Ningxia) ",
        "eu-central-1"       => "EU (Frankfurt)",
        "eu-north-1"         => "EU (Stockholm)",
        "eu-south-1"         => "EU (Milan)",
        "eu-west-1"          => "EU (Ireland)",
        "eu-west-2"          => "EU (London) ",
        "eu-west-3"          => "EU (Paris)",
        "me-south-1"         => "Middle East (Bahrain)",
        "sa-east-1"          => "America (Sao Paulo)",
        "us-east-1"          => "US East (N. Virginia)",
        "us-east-2"          => "US East (Ohio)",
        // "us-gov-east-1"      => "GovCloud (US-East)",
        // "us-gov-secret-1"    => "AWS Secret Region (US-Secret)",
        // "us-gov-topsecret-1" => "AWS Top Secret Region (US-Secret)",
        // "us-gov-west-1"      => "GovCloud (US-West)",
        "us-west-1"          => "US West (N. California)",
        "us-west-2"          => "US West (Oregon)",
    ];

    const DEFAULT = [
        "eu-west-1",
        "eu-west-2",
        "us-east-1",
    ];
}
