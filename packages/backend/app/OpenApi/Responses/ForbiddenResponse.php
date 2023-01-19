<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\ForbiddenResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ForbiddenResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::forbidden()
            ->description('Forbidden')
            ->content(
                MediaType::json()
                    ->schema(ForbiddenResponseSchema::ref())
            );
    }
}
