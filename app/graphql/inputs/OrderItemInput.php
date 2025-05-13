<?php

namespace App\graphql\inputs;

use App\graphql\GraphQLTypes;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class OrderItemInput extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'OrderItemInput',
            'fields' => [
                'productId' => Type::nonNull(Type::string()),
                'quantity' => Type::nonNull(Type::int()),
                'productAttributes' => Type::nonNull(Type::listOf(Type::nonNull(GraphQLTypes::attributeSetInput()))),
            ],
        ];
        parent::__construct($config);
    }
}
