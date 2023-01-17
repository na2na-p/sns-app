<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\MessageListRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class MessageListRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('MessageList')
            ->description('Message List Request Body')
            ->content(
                MediaType::json()->schema(
                    MessageListRequestBodySchema::ref()
                )
            );
    }
}
