<?php

namespace App\graphql\types;

use App\graphql\GraphQLTypes;
use App\models\CategoryModel;
use App\models\OrderModel;
use App\models\ProductModel;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType
{
    public static function handleQueryType()
    {
        return new ObjectType([
            'name' => 'Query',
            'fields' => [
                'categories' => [
                    'type' => Type::nonNull(Type::listOf(GraphQLTypes::category())),
                    'resolve' => function ($root, $args, $context) {
                        return CategoryModel::getAll($context["db"]);
                    },
                ],
                'products' => [
                    'type' => Type::nonNull(Type::listOf(GraphQLTypes::product())),
                    'resolve' => function ($root, $args, $context) {
                        return ProductModel::getAll($context["db"]);
                    },
                ],
                'orders' => [
                    'type' => Type::nonNull(Type::listOf(GraphQLTypes::order())),
                    'resolve' => function ($root, $args, $context) {
                        return OrderModel::getAll($context["db"]);
                    },
                ],
                "product" => [
                    'type' => Type::nonNull(GraphQLTypes::product()),
                    'args' => [
                        'id' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args, $context) {
                        return ProductModel::getById($args, $context["db"]);
                    },
                ],
            ],
        ]);
    }
}
