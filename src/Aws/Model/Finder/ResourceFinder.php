<?php

namespace App\Aws\Model\Finder;

use App\Aws\Model\Resource;
use Ronanchilvers\Orm\Finder;

/**
 * Finder for resources
 */
class ResourceFinder extends Finder
{
    /**
     * Find a set of resources for a given filter
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function forFilters($type, $account, $region)
    {
        $select = $this->select()
            ->orderby(Resource::prefix('name'));
        if (!empty($type)) {
            $type = "arn:aws:{$type}%";
            $select->where(Resource::prefix('arn'), 'like', $type);
        }
        if (!empty($account)) {
            $select->where(Resource::prefix('account'), '=', $account);
        }
        if (!empty($region)) {
            $select->where(Resource::prefix('region'), '=', $region);
        }

        return $select->execute();
    }
}
