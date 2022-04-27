<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class BaseRepository
{
    /**
     * @throws ValidationException
     */
    protected function checkExistsColumns(array $fields, string $table_name)
    {
        $errors = [];

        foreach ($fields as $key => $value) {
            if (!Schema::hasColumn($table_name, $key)){
                $errors[$key] = "The field does not exist";
            }
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages([$key => 'The field does not exist']);
        }
    }
}
