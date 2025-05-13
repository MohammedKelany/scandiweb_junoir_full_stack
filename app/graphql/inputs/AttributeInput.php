<?php

namespace App\graphql\inputs;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class AttributeInput extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'attributeName' => Type::nonNull(Type::string()),
                'value' => Type::nonNull(Type::string()),
            ]
        ];

        parent::__construct($config);
    }
}
