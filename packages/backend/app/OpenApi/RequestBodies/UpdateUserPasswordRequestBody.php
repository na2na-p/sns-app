<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateUserPasswordRequestBody extends RequestBodyFactory
{
    /**
     * @return RequestBody
     *
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateUserPassword')
            ->description('Update user password Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    Schema::object('UpdateUserPasswordRequestBody')
                        ->properties(
                            Schema::string('password')
                        )
                        ->required('password')
                )
            );
    }
}
