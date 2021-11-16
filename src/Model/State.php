<?php

namespace App\Model;

use Respect\Validation\Validator;
use Ronanchilvers\Orm\Model;
use Ronanchilvers\Orm\Orm;
use Ronanchilvers\Orm\Traits\HasValidationTrait;

class State extends Model
{
    use HasValidationTrait;

    static protected $columnPrefix = 'state';

    public static function is($key, $value): bool
    {
        $actual = static::pick($key, null);

        return $value == $actual;
    }

    public static function pick($key, $default = null): ?string
    {
        $state = Orm::finder(State::class)->select()
            ->where(State::prefix('key'), $key)
            ->one();
        if ($state instanceof State) {
            return $state->value;
        }

        return $default;
    }

    public static function put($key, $value): ?string
    {
        $state = Orm::finder(State::class)->select()
            ->where(State::prefix('key'), $key)
            ->one();
        if (!$state instanceof State) {
            $state        = new State();
            $state->key   = $key;
            $state->value = null;
        }
        $oldValue = $state->value;
        $state->value = $value;
        if (!$state->saveWithValidation()) {
            return null;
        }
        if (empty($oldValue)) {
            $oldValue = null;
        }

        return $oldValue;
    }

    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    protected function setupValidation()
    {
        $this->registerRules([
            'key'   => Validator::stringType()->notEmpty(),
            'value' => Validator::stringType()->notEmpty(),
        ]);
    }
}
