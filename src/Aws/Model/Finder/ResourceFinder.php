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
    public function forFilters(array $params)
    {
        $select = $this->select()
            ->orderby(Resource::prefix('name'));
        $map = [
            'type'    => 'arn',
            'account' => 'account',
            'region'  => 'region',
            'state'   => 'state',
        ];
        foreach ($map as $key => $field) {
            if (isset($params[$key]) && !empty($params[$key])) {
                $value = $params[$key];
                $operator = '=';
                if ('arn' == $field) {
                    $value    = "arn:aws:{$value}%";
                    $operator = 'like';
                }
                $select->where(
                    Resource::prefix($field),
                    $operator,
                    $value
                );
            }
        }

        return $select->execute();
    }
}
