<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\UpdateUserPasswordRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateUserPasswordRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateUserPassword')
            ->description('Update user password Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    UpdateUserPasswordRequestBodySchema::ref()
                )
            );
    }
}
