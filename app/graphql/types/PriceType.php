<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\GraphQLTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PDO;

class PriceType extends ObjectType
{
    /**
     * PriceType constructor.
     */
    public function __construct()
    {
        $config = [
            'fields' => [
                'amount' => Type::nonNull(Type::float()),
                'currency' => Type::nonNull(GraphQLTypes::currency()),
            ],
        ];
        parent::__construct($config);
    }
}
