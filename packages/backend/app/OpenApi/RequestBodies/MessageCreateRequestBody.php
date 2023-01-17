<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\MessageCreateRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class MessageCreateRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('MessageCreate')
            ->description('Message Create Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    MessageCreateRequestBodySchema::ref()
                )
            );
    }
}
