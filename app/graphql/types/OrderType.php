<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\GraphQLTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderType extends ObjectType
{
    /**
     * OrderType constructor.
     */
    public function __construct()
    {
        $config = [
            'name' => 'Order',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'total_price' => Type::nonNull(Type::float()),
                'created_at' => Type::nonNull(Type::string()),
                "products" => Type::nonNull(Type::listOf(GraphQLTypes::orderItem())),
            ],
        ];
        parent::__construct($config);
    }
}
