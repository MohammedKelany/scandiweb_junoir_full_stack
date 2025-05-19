import { useState } from 'react';
import PropTypes from 'prop-types';
import { useStateContext } from '../../../contexts/ContextProvider';
import SafeHtmlParser from '../../../parser/parser';
import "./product_attributes.css";

const ProductAttributes = ({
    product,
    isModalView = false,
    itemSelectedAttributes = [],
    cartItemId = null,
}) => {
    const { addToCart, updateCartItemAttribute } = useStateContext();
    const [selectedAttributes, setSelectedAttributes] = useState(
        itemSelectedAttributes
    );
    const totalPrice =
        product.prices && product.prices.length > 0
            ? `${product.prices[0].currency.symbol} ${(
                parseFloat(product.prices[0]?.amount) * (product.quantity ?? 1)
            ).toFixed(2)}`
            : null;

    const handleAttributeClick = (attribute) => {
        const existingIndex = selectedAttributes.findIndex(
            (attr) => attribute.attributeName === attr.attributeName
        );
        const updatedSelectedAttributes = [...selectedAttributes];

        if (existingIndex !== -1) {
            updatedSelectedAttributes[existingIndex] = {
                id: attribute.id,
                attributeName: attribute.attributeName,
                value: attribute.value,
            };
        } else {
            updatedSelectedAttributes.push({
                id: attribute.id,
                attributeName: attribute.attributeName,
                value: attribute.value,
            });
        }

        setSelectedAttributes(updatedSelectedAttributes);

        if (isModalView && cartItemId) {
            updateCartItemAttribute(
                cartItemId,
                updatedSelectedAttributes,
            );
        }
    };

    const isAttributeValueSelected = (attribute) => {
        return selectedAttributes.some(
            (attr) =>
                attribute.attributeName === attr.attributeName &&
                attribute.value === attr.value &&
                attribute.id === attr.id
        );
    };

    return (
        <div className={"product-attributes"}>
            <h2 className={isModalView ? "cart-title" : 'product-title'}>
                {product.name}
            </h2>

            {isModalView && <div className="title-sm gap">{totalPrice}</div>}

            {product.attributes?.map((attributeSet) => (
                <div
                    key={attributeSet.id}
                    className="attribute-set"
                    data-testid={`${isModalView ? 'cart-item' : 'product'}-attribute-${attributeSet.name.replace(/\s+/g, '-').toLowerCase()}`
                    }>

                    <h3 className={`${isModalView ? "title-sm" : "title-md"}`}>{attributeSet.name}:</h3>

                    <div className={`attribute-items`}>
                        {attributeSet.items.map((attribute) =>
                            attributeSet.type?.toLowerCase() === 'swatch' &&
                                attributeSet.name?.toLowerCase() === 'color' ? (
                                <button
                                    type="button"
                                    key={attribute.id}
                                    className={`${isModalView ? "color-button-cart" : "color-button-product"} ${isAttributeValueSelected(attribute) ? "color-selected" : ""} `}
                                    style={{ backgroundColor: attribute.value }}
                                    title={attribute.displayValue}
                                    onClick={() => handleAttributeClick(attribute)}
                                    disabled={!product.inStock}
                                    data-testid={`${isModalView ? 'cart-item' : 'product'
                                        }-attribute-${attributeSet.name.replace(/\s+/g, '-').toLowerCase()}-${isModalView
                                            ? attribute.displayValue.replace(/\s+/g, '-')
                                            : attribute.value
                                        }${isAttributeValueSelected(attribute) && isModalView
                                            ? '-selected'
                                            : ''
                                        }`}
                                >
                                </button>
                            ) : (
                                <button
                                    type="button"
                                    key={attribute.id}
                                    className={`${isModalView ? "attr-button-cart" : "attr-button-product"} ${isAttributeValueSelected(attribute) ? "attr-selected" : ""}`}
                                    disabled={!product.inStock}
                                    onClick={() => handleAttributeClick(attribute)}
                                    data-testid={`${isModalView ? 'cart-item' : 'product'
                                        }-attribute-${attributeSet.name.replace(
                                            /\s+/g,
                                            '-'
                                        ).toLowerCase()}-${attribute.displayValue.replace(/\s+/g, '-')}${isAttributeValueSelected(attribute) ? '-selected' : ''
                                        }`}
                                >
                                    {attribute.displayValue}
                                </button>
                            )
                        )}
                    </div>
                </div>
            ))}

            {!isModalView && (
                <>
                    <h3 className="title-md">Price:</h3>
                    <div className="title-bg gap">
                        {product.prices &&
                            product.prices.length > 0 &&
                            `${product.prices[0]?.amount}${product.prices[0]?.currency.symbol}`}
                    </div>
                </>
            )}
            {!isModalView && product.inStock && (
                <button
                    className='place-order-button'
                    type="button"
                    style={{
                        backgroundColor: product.attributes.length !== selectedAttributes.length ? "var(--disabled-color)" : "var(--primary)",
                    }}
                    onClick={() => addToCart(product, true, selectedAttributes)}
                    disabled={product.attributes.length !== selectedAttributes.length}
                    data-testid="add-to-cart">
                    Add To cart
                </button>
            )}

            {!isModalView && (
                <div className='product-description' data-testid="product-description">
                    {SafeHtmlParser({ htmlString: product.description })}
                </div>
            )}
        </div>
    );
};

ProductAttributes.propTypes = {
    product: PropTypes.object.isRequired,
    className: PropTypes.string,
    isModalView: PropTypes.bool,
    itemSelectedAttributes: PropTypes.array,
};

export default ProductAttributes;