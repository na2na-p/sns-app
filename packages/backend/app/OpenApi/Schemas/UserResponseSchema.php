<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class UserResponseSchema extends SchemaFactory implements Reusable
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): SchemaContract
    {
        return Schema::object('UserResponse')
            ->properties(
                Schema::string('id'),
                Schema::string('name'),
                Schema::string('email'),
            )
            ->required('id', 'name', 'email');
    }
}
