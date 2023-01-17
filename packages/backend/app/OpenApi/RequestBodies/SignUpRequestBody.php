<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\SignUpRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class SignUpRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('Signup')
            ->description('SignUp Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    SignUpRequestBodySchema::ref()
                )
            );
    }
}
