<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\UserResponseSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class SignUpResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('SignUp Successful')
            ->statusCode(201)
            ->content(
                MediaType::json()->schema(
                    UserResponseSchema::ref()
                )
            );
    }
}
