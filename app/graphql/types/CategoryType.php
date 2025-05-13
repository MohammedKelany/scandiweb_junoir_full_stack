<?php

namespace App\graphql\types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            "name" => "Category",
            'fields' => [
                'id' => [
                    'type' => Type::nonNull(Type::id()),
                    'resolve' => fn ($cat) => $cat["id"],
                ],
                'name' => [
                    'type' => Type::nonNull(Type::string()),
                    'resolve' => fn ($cat) => $cat["name"],
                ],
            ],
        ];

        parent::__construct($config);
    }
}
