<?php

namespace App\graphql\types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeType extends ObjectType
{
    public function __construct()
    {
        $config = [
            "name" => "Attribute",
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'displayValue' => Type::string(),
                'value' => Type::nonNull(Type::string()),
                'attributeName' => Type::nonNull(Type::string()),
            ]
        ];

        parent::__construct($config);
    }
}
