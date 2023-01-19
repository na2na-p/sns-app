<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\BadRequestResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class BadRequestResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::badRequest()
            ->description('Bad Request')
            ->content(
                MediaType::json()
                    ->schema(BadRequestResponseSchema::ref())
            );
    }
}
