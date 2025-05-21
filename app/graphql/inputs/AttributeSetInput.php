<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use App\graphql\GraphQLTypes;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class AttributeSetInput extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'name' => Type::nonNull(Type::string()),
                'type' => Type::nonNull(Type::string()),
                'selectedAttributes' => Type::nonNull(Type::listOf(GraphQLTypes::attributeInput())),
            ],
        ];

        parent::__construct($config);
    }
}
