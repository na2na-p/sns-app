<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class AddFavoriteResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('FavoriteReverse Successful');
    }
}
