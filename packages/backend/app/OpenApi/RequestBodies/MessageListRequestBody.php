<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class MessageListRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('MessageList')
            ->description('Message List Request Body')
            ->content(
                MediaType::json()->schema(
                    Schema::object('MessageListRequestBody')
                        ->properties(
                            Schema::integer('perPage'),
                            Schema::string('lastMessageId'),
                        )
                )
            );
    }
}
