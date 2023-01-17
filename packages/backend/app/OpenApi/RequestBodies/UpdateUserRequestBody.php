<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\UpdateUserRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateUserRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateUser')
            ->description(' Update user info Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    UpdateUserRequestBodySchema::ref()
                )
            );
    }
}
