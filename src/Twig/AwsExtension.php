<?php

namespace App\Twig;

use App\Aws\Region;
use App\Facades\Session;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

/**
 * Extension to add helper methods for AWS
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class AwsExtension extends AbstractExtension
{
    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function getFilters()
    {
        return [
            new TwigFilter('region_label', [$this, 'getRegionLabel']),
        ];
    }

    /**
     * Get the region label
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function getRegionLabel($region)
    {
        $all = Region::ALL;
        if (array_key_exists($region, $all)) {
            return $all[$region];
        }

        return $region;
    }
}
