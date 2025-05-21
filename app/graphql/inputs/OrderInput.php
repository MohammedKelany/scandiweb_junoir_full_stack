<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use App\graphql\GraphQLTypes;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class OrderInput extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'OrderInput',
            'fields' => [
                'items' => Type::nonNull(Type::listOf(Type::nonNull(GraphQLTypes::orderItemInput()))),
            ]
        ];
        parent::__construct($config);
    }
}
