<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginRequestBody extends RequestBodyFactory
{
    /**
     * @return RequestBody
     *
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create('Login')
            ->description('Login Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    Schema::object('LoginRequestBody')
                        ->properties(
                            Schema::string('email'),
                            Schema::string('password'),
                        )
                        ->required('email', 'password')
                )
            );
    }
}
