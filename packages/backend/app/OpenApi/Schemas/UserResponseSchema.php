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
     * @return SchemaContract
     */
    public function build(): SchemaContract
    {
        try {
            return Schema::object('UserResponse')
                ->properties(
                    Schema::string('id'),
                    Schema::string('name'),
                    Schema::string('email'),
                )
                ->required('id', 'name', 'email');
        } catch (InvalidArgumentException $e) {
            dd($e);
        }
    }
}
