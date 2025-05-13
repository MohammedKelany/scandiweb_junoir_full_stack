<?php

namespace App\graphql\types;

use App\graphql\GraphQLTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeSetType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'AttributeSet',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'name' => Type::nonNull(Type::string()),
                'type' => Type::nonNull(Type::string()),
                'items' => Type::nonNull(Type::listOf(GraphQLTypes::attribute())),
                "selectedAttributes" => Type::listOf(
                    GraphQLTypes::attribute()
                ),
            ],
        ];

        parent::__construct($config);
    }
}
