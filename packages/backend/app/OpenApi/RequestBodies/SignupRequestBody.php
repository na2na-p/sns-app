<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class SignupRequestBody extends RequestBodyFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create('Signup')
            ->description('Signup Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    Schema::object('SignupRequestBody')
                        ->properties(
                            Schema::string('name'),
                            Schema::string('email'),
                            Schema::string('password'),
                        )
                        ->required('name', 'email', 'password')
                )
            );
    }
}
