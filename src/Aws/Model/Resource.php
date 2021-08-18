<?php

namespace App\Aws\Model;

use App\Aws\Model\Account;
use Respect\Validation\Validator;
use Ronanchilvers\Orm\Model;
use Ronanchilvers\Orm\Traits\HasValidationTrait;

/**
 * Model representing an AWS resource
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Resource extends Model
{
    use HasValidationTrait;

    static protected $columnPrefix = 'resource';

    /**
     * Boot the model
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function boot()
    {
        $this->addType('model', 'account', [
            'class' => Account::class
        ]);
    }

    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function setupValidation()
    {
        $this->registerRules([
            'arn'    => Validator::stringType()->notEmpty(),
            'name'   => Validator::stringType()->notEmpty(),
            'region' => Validator::stringType()->notEmpty(),
            'state'  => Validator::stringType()->notEmpty(),
        ]);
    }
}
