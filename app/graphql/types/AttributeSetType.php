<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\GraphQLTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeSetType extends ObjectType
{
    /**
     * AttributeSetType constructor.
     */
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
