<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use App\GraphQL\GraphQLTypes;
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
