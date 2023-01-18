<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\SignupRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class SignupRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('Signup')
            ->description('Signup Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    SignupRequestBodySchema::ref()
                )
            );
    }
}
