<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\LoginRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('Login')
            ->description('Login Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    LoginRequestBodySchema::ref()
                )
            );
    }
}
