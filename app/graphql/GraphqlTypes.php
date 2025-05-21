<?php

declare(strict_types=1);

namespace App\GraphQL;

use App\GraphQL\Inputs\AttributeInput;
use App\GraphQL\Inputs\AttributeSetInput;
use App\GraphQL\Inputs\OrderInput;
use App\GraphQL\Inputs\OrderItemInput;
use App\GraphQL\Types\AttributeSetType;
use App\GraphQL\Types\AttributeType;
use App\GraphQL\Types\CategoryType;
use App\GraphQL\Types\CurrencyType;
use App\GraphQL\Types\OrderItemType;
use App\GraphQL\Types\OrderType;
use App\GraphQL\Types\PriceType;
use App\GraphQL\Types\ProductType;

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

    /**
     * Returns the CategoryType instance (singleton).
     *
     * @return CategoryType
     */
    public static function category(): CategoryType
    {
        return self::$category ??= new CategoryType();
    }

    /**
     * Returns the ProductType instance (singleton).
     *
     * @return ProductType
     */
    public static function product(): ProductType
    {
        return self::$product ??= new ProductType();
    }

    /**
     * Returns the PriceType instance (singleton).
     *
     * @return PriceType
     */
    public static function price(): PriceType
    {
        return self::$price ??= new PriceType();
    }

    /**
     * Returns the AttributeType instance (singleton).
     *
     * @return AttributeType
     */
    public static function attribute(): AttributeType
    {
        return self::$attribute ??= new AttributeType();
    }

    /**
     * Returns the AttributeSetType instance (singleton).
     *
     * @return AttributeSetType
     */
    public static function attributeSet(): AttributeSetType
    {
        return self::$attributeSet ??= new AttributeSetType();
    }

    /**
     * Returns the CurrencyType instance (singleton).
     *
     * @return CurrencyType
     */
    public static function currency(): CurrencyType
    {
        return self::$currency ??= new CurrencyType();
    }

    /**
     * Returns the OrderType instance (singleton).
     *
     * @return OrderType
     */
    public static function order(): OrderType
    {
        return self::$order ??= new OrderType();
    }

    /**
     * Returns the OrderItemType instance (singleton).
     *
     * @return OrderItemType
     */
    public static function orderItem(): OrderItemType
    {
        return self::$orderItem ??= new OrderItemType();
    }

    /**
     * Returns the OrderInput instance (singleton).
     *
     * @return OrderInput
     */
    public static function orderInput(): OrderInput
    {
        return self::$orderInput ??= new OrderInput();
    }

    /**
     * Returns the OrderItemInput instance (singleton).
     *
     * @return OrderItemInput
     */
    public static function orderItemInput(): OrderItemInput
    {
        return self::$orderItemInput ??= new OrderItemInput();
    }

    /**
     * Returns the AttributeSetInput instance (singleton).
     *
     * @return AttributeSetInput
     */
    public static function attributeSetInput(): AttributeSetInput
    {
        return self::$attributeSetInput ??= new AttributeSetInput();
    }

    /**
     * Returns the AttributeInput instance (singleton).
     *
     * @return AttributeInput
     */
    public static function attributeInput(): AttributeInput
    {
        return self::$attributeInput ??= new AttributeInput();
    }
}
