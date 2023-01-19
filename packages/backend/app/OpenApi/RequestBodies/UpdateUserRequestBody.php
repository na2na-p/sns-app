<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateUserRequestBody extends RequestBodyFactory
{
    /**
     * @return RequestBody
     *
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateUser')
            ->description(' Update user info Request Body')
            ->required()
            ->content(
                MediaType::json()->schema(
                    Schema::object('UpdateUserRequestBody')
                        ->properties(
                            Schema::string('name'),
                            Schema::string('email'),
                        )
                        ->required('name', 'email')
                )
            );
    }
}
