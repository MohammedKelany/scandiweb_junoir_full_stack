<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use App\GraphQL\GraphQLTypes;
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
