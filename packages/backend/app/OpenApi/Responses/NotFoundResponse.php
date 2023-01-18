<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\NotFoundResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class NotFoundResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::notFound()
            ->description('Not Found')
            ->content(
                MediaType::json()
                    ->schema(NotFoundResponseSchema::ref())
            );
    }
}
