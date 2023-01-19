<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class AddFavoriteRequestBody extends RequestBodyFactory
{
    /**
     * @return RequestBody
     *
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create('FavoriteReverse')
            ->description('FavoriteReverse Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    Schema::object('FavoriteReverseRequestBody')
                        ->properties(
                            Schema::boolean('isFavorite')
                        )
                        ->required('isFavorite')
                )
            );
    }
}
