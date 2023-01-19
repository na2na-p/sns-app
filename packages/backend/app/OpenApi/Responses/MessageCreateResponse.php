<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class MessageCreateResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::created()
            ->description('Message Create Successful');
    }
}
