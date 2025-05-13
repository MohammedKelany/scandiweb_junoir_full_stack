<?php

namespace App\graphql\inputs;

use App\graphql\GraphQLTypes;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;


class OrderInput extends InputObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'OrderInput',
            'fields' => [
                'items' => Type::nonNull(Type::listOf(Type::nonNull(GraphQLTypes::orderItemInput()))),
            ]
        ]);
    }
}
