<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class MessageCreateRequestBody extends RequestBodyFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create('MessageCreate')
            ->description('Message Create Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    Schema::object('MessageCreateBody')
                        ->properties(
                            Schema::string('body')
                        )
                        ->required('body')
                )
            );
    }
}
