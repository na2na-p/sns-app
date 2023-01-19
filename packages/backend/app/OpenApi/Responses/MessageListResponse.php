<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class MessageListResponse extends ResponseFactory
{
    /**
     * @return Response
     *
     * @throws InvalidArgumentException
     */
    public function build(): Response
    {
        return Response::ok()
            ->description('Get Message List')
            ->content(
                MediaType::json()->schema(
                    Schema::array('MessageListResponse')
                        ->items(
                            Schema::object()
                                ->properties(
                                    Schema::string('id'),
                                    Schema::string('body'),
                                    Schema::string('created_by'),
                                    Schema::string('created_at'),
                                    Schema::boolean('isFavorite'),
                                    Schema::integer('favoritesCount'),
                                )
                                ->required('id', 'user_id', 'body', 'created_by', 'created_at', 'isFavorite', 'favoritesCount')
                        )
                )
            );
    }
}
