<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class BadRequestResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::badRequest()
            ->description('Bad Request')
            ->content(
                MediaType::json()
                    ->schema(Schema::object('BadRequestResponse')
                        ->properties(
                            Schema::string('message')->nullable(),
                            Schema::object('errors')->nullable()
                        ))
            );
    }
}
