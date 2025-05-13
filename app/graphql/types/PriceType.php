<?php

namespace App\graphql\types;

use App\graphql\GraphQLTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PDO;

class PriceType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'amount' => Type::nonNull(Type::float()),
                'currency' => Type::nonNull(GraphQLTypes::currency()),
            ],
        ];
        parent::__construct($config);
    }
}
