<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\MessageListResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class MessageListResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('Get Message List')
            ->content(
                MediaType::json()->schema(
                    MessageListResponseSchema::ref()
                )
            );
    }
}
