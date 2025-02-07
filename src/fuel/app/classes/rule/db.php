<?php

use Fuel\Core\DB;
use Fuel\Core\Validation;
class Rule_Db
{
    public static function _validation_unique($val, $option)
    {
        list($table, $field) = explode('.', $option);

        $result = DB::select(DB::expr("LOWER (\"$field\")"))
            ->where($field, '=', Str::lower($val))
            ->from($table)->execute();
        Validation::active()->set_message('unique', 'The field :label must be unique, but :value has already been used');

        return ! ($result->count() > 0);
    }

    public static function _validation_exist($val, $option)
    {
        list($table, $field) = explode('.', $option);
        $result = DB::select(DB::expr($field))
            ->where($field, '=', Str::lower($val))
            ->from($table)->execute();
        Validation::active()->set_message('exist', ':label = :value is not exist');

        return $result->count() > 0;

    }
}