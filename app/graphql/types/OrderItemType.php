<?php

namespace App\graphql\types;

use App\graphql\GraphQLTypes;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderItemType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'OrderItem',
            'fields' => [
                'product_id' => Type::nonNull(Type::string()),
                'quantity' => Type::nonNull(Type::int()),
                'product_attributes' => [
                    "type" => Type::listOf(GraphQLTypes::attributeSet()),
                    "resolve" => function ($orderItem, $args, $context) {
                        $data = json_decode($orderItem["product_attributes"]);
                        return $data;
                    },
                ],
            ],
        ];
        parent::__construct($config);
    }
}
