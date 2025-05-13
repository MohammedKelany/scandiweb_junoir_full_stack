<?php

namespace App\graphql;

use App\graphql\inputs\AttributeInput;
use App\graphql\inputs\AttributeSetInput;
use App\graphql\inputs\OrderInput;
use App\graphql\inputs\OrderItemInput;
use App\graphql\types\AttributeSetType;
use App\graphql\types\AttributeType;
use App\graphql\types\CategoryType;
use App\graphql\types\CurrencyType;
use App\graphql\types\OrderItemType;
use App\graphql\types\PriceType;
use App\graphql\types\ProductType;
use App\graphql\types\OrderType;

class GraphQLTypes
{
    private static $category;
    private static $product;
    private static $price;
    private static $attribute;
    private static $attributeSet;
    private static $currency;
    private static $order;
    private static $orderItem;
    private static $orderInput;
    private static $orderItemInput;
    private static $attributeSetInput;
    private static $attributeInput;


    public static function category()
    {
        return self::$category ??= new CategoryType();
    }

    public static function product()
    {
        return self::$product ??= new ProductType();
    }
    public static function price()
    {
        return self::$price ??= new PriceType();
    }

    public static function attribute()
    {
        return self::$attribute ??= new AttributeType();
    }
    public static function attributeSet()
    {
        return self::$attributeSet ??= new AttributeSetType();
    }

    public static function currency()
    {
        return self::$currency ??= new CurrencyType();
    }
    public static function order()
    {
        return self::$order ??= new OrderType();
    }
    public static function orderItem()
    {
        return self::$orderItem ??= new OrderItemType();
    }
    public static function orderInput()
    {
        return self::$orderInput ??= new OrderInput();
    }
    public static function orderItemInput()
    {
        return self::$orderItemInput ??= new OrderItemInput();
    }
    public static function attributeSetInput()
    {
        return self::$attributeSetInput ??= new AttributeSetInput();
    }
    public static function attributeInput()
    {
        return self::$attributeInput ??= new AttributeInput();
    }
}
