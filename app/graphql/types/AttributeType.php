<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeType extends ObjectType
{
    /**
     * AttributeType constructor.
     */
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
