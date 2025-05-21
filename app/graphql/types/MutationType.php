<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\GraphQLTypes;
use App\Models\OrderModel;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType
{
    /**
     * Returns an ObjectType (GraphQL Mutation) for the schema.
     *
     * @return ObjectType
     */
    public static function handleMutationType(): ObjectType
    {
        return new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'addOrder' => [
                    'type' => GraphQLTypes::order(),
                    'args' => [
                        'input' => Type::nonNull(GraphQLTypes::orderInput())
                    ],
                    'resolve' => function ($root, $args, $context) {
                        return OrderModel::addOrder($args, $context["db"]);
                    }
                ]
            ]
        ]);
    }
}
