<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\FavoriteReverseRequestBodySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class FavoriteReverseRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('FavoriteReverse')
            ->description('FavoriteReverse Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    FavoriteReverseRequestBodySchema::ref()
                )
            );
    }
}
