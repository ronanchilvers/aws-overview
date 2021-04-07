<?php

namespace App\Aws\Model;

use Respect\Validation\Validator;
use Ronanchilvers\Orm\Model;
use Ronanchilvers\Orm\Traits\HasValidationTrait;

class Account extends Model
{
    use HasValidationTrait;

    static protected $columnPrefix = 'account';

    /**
     * Boot the model
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function boot()
    {
        $this->addType('array', 'regions');
    }

    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function setupValidation()
    {
        $this->registerRules([
            'name'    => Validator::stringType()->notEmpty(),
            'key'     => Validator::stringType()->notEmpty(),
            'secret'  => Validator::stringType()->notEmpty(),
            'regions' => Validator::stringType()->notEmpty(),
        ]);
    }

    /**
     * Does this account have this region?
     *
     * @param string $region
     * @return bool
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function hasRegion($region): bool
    {
        return in_array(
            $region,
            $this->regions
        );
    }
}
