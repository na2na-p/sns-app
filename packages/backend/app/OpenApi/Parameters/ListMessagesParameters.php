<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListMessagesParameters extends ParametersFactory
{
    /**
     * @return array<Parameter>
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('perPage')
                ->description('Number of messages per page')
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('lastMessageId')
                ->description('Last message ID')
                ->schema(Schema::string()),
        ];
    }
}
