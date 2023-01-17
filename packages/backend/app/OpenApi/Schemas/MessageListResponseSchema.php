<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class MessageListResponseSchema extends SchemaFactory implements Reusable
{
    /**
     * @return SchemaContract
     */
    public function build(): SchemaContract
    {
        try {
            return Schema::array('MessageListResponse')
                ->items(
                    Schema::object()
                        ->properties(
                            Schema::string('id'),
                            Schema::string('user_id'),
                            Schema::string('body'),
                            Schema::string('created_at'),
                            Schema::boolean('isFavorite'),
                            Schema::integer('favoritesCount'),
                        )
                        ->required('id', 'user_id', 'body', 'created_at', 'isFavorite', 'favoritesCount')
                );
        } catch (InvalidArgumentException $e) {
            dd($e);
        }
    }
}
