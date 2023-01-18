<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class SignupRequestBodySchema extends SchemaFactory implements Reusable
{
    /**
     * @return SchemaContract
     */
    public function build(): SchemaContract
    {
        try {
            return Schema::object('SignupRequestBody')
                ->properties(
                    Schema::string('name'),
                    Schema::string('email'),
                    Schema::string('password'),
                )
                ->required('name', 'email', 'password');
        } catch (InvalidArgumentException $e) {
            dd($e);
        }
    }
}