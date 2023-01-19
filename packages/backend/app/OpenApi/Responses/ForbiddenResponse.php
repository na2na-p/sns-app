<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ForbiddenResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::forbidden()
            ->description('Forbidden')
            ->content(
                MediaType::json()
                    ->schema(
                        Schema::object('ForbiddenResponse')
                            ->properties(
                                Schema::string('message')->nullable(),
                            )
                    )
            );
    }
}
