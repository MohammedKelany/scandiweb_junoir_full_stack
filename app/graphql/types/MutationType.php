<?php

namespace App\graphql\types;

use App\graphql\GraphQLTypes;
use App\models\OrderModel;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType
{
    public static function handleMutationType()
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
