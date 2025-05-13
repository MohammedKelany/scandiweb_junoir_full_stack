<?php

namespace App\graphql\types;

use App\graphql\GraphQLTypes;
use App\models\AttributeSetModel;
use App\models\CategoryModel;
use App\models\PriceModel;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends ObjectType
{
    public function __construct()
    {
        $config = [
            "name" => "Product",
            'fields' => function () {
                return [
                    'id' => Type::nonNull(Type::id()),
                    'name' => Type::nonNull(Type::string()),
                    'inStock' => Type::nonNull(Type::boolean()),
                    'gallery' => [
                        "type" => Type::nonNull(Type::listOf(Type::string())),
                        "resolve" => function ($product) {
                            $stringGallery = $product["gallery"];
                            return json_decode($stringGallery, true);
                        },
                    ],
                    'description' => Type::nonNull(Type::string()),
                    'brand' => Type::nonNull(Type::string()),
                    'category' => [
                        'type' => Type::nonNull(GraphQLTypes::category()),
                        'resolve' => function ($product, $args, $context) {
                            return CategoryModel::getById($product, $context["db"]);
                        },
                    ],
                    'attributes' => [
                        'type' => Type::nonNull(Type::listOf(GraphQLTypes::attributeSet())),
                        'resolve' => function ($product, $args, $context) {
                            return AttributeSetModel::getById($product, $context["db"]);
                        },
                    ],
                    'prices' => [
                        'type' => Type::nonNull(Type::listOf(GraphQLTypes::price())),
                        'resolve' => function ($product, $args, $context) {
                            return PriceModel::getAll($product, $context["db"]);
                        },
                    ],
                ];
            },
        ];
        parent::__construct($config);
    }
}
