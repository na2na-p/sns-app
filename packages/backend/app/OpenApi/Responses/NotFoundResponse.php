<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class NotFoundResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::notFound()
            ->description('Not Found')
            ->content(
                MediaType::json()->schema(
                    Schema::object('NotFoundResponse')
                        ->properties(
                            Schema::string('message')->nullable()
                        )
                )
            );
    }
}
