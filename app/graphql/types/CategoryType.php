<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType extends ObjectType
{
    /**
     * CategoryType constructor.
     */
    public function __construct()
    {
        $config = [
            "name" => "Category",
            'fields' => [
                'id' => [
                    'type' => Type::nonNull(Type::id()),
                    'resolve' => fn($cat) => $cat["id"],
                ],
                'name' => [
                    'type' => Type::nonNull(Type::string()),
                    'resolve' => fn($cat) => $cat["name"],
                ],
            ],
        ];

        parent::__construct($config);
    }
}
