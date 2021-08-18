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
     * To String method
     *
     * @return string
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __toString(): string
    {
        return $this->name;
    }

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
        if (empty($this->regions)) {
            return false;
        }
        return in_array(
            $region,
            $this->regions
        );
    }

    /**
     * Get a credentials array
     *
     * @return array
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function getCredentialsArray(): array
    {
        return [
            'key'    => $this->key,
            'secret' => $this->secret,
        ];
    }
}
