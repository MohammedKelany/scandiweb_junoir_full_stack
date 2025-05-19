import { useMutation } from '@apollo/client';
import { useMemo, useCallback } from 'react';
import { ADD_ORDER } from "../../../graphql/mutations";
import { useStateContext } from '../../../contexts/ContextProvider';
import ProductAttributes from './../../Partials/ProductAttributes/ProductAttributes';
import "./cart_overlay.css";
import { toast } from 'react-toastify';

const CartOverlay = () => {
    const { updateCartItemQuantity, cartItems, emptyCart, totalPrice, cartOverlayOpen, setCartOverlayOpen } = useStateContext();
    const [addOrder, { loading }] = useMutation(ADD_ORDER);

    const closeOverlay = useCallback(() => {
        setCartOverlayOpen(!cartOverlayOpen);
        document.body.style.overflow = !cartOverlayOpen ? 'hidden' : '';
    }, [cartOverlayOpen, setCartOverlayOpen]);

    // Memoize cart items to prevent unnecessary re-renders
    const cartItemsList = useMemo(() => {
        return cartItems.map((cartItem) => (
            <div className='cart-product' key={cartItem.id}>
                <div className='cart-product-properties'>
                    <ProductAttributes
                        key={cartItem.id + JSON.stringify(cartItem.selectedAttributes)}
                        product={cartItem.product}
                        isModalView={true}
                        itemSelectedAttributes={cartItem.selectedAttributes}
                        cartItemId={cartItem.id}
                    />
                </div>
                <div className='cart-product-properties'>
                    <div className='cart-product-quantity'>
                        <button
                            data-testid='cart-item-amount-increase'
                            className='add-button'
                            onClick={() => updateCartItemQuantity(
                                cartItem.product.id,
                                cartItem.quantity,
                                "add",
                                cartItem.id
                            )}
                            aria-label="Increase quantity">
                            +
                        </button>
                        <span
                            data-testid='cart-item-amount'
                            className='quantity-text'>
                            {cartItem.quantity}
                        </span>
                        <button
                            data-testid='cart-item-amount-decrease'
                            className='minus-button'
                            onClick={() => updateCartItemQuantity(
                                cartItem.product.id,
                                cartItem.quantity,
                                "minus",
                                cartItem.id
                            )}
                            aria-label="Decrease quantity">
                            -
                        </button>
                    </div>
                    <div className='cart-product-image-container'>
                        <img
                            className='cart-product-image'
                            src={cartItem.product.gallery[0]}
                            alt={`${cartItem.product.name} in cart`}
                            loading="lazy"
                        />
                    </div>
                </div>
            </div>
        ));
    }, [cartItems, updateCartItemQuantity]);

    const handlePlaceOrder = useCallback(async () => {
        if (cartItems.length === 0) {
            toast.error("Please Select some products !!!", {
                closeOnClick: true,
                position: "bottom-right",
            });
            return;
        }

        try {
            await addOrder({
                variables: {
                    input: {
                        items: cartItems.map(item => ({
                            productId: item.product.id,
                            quantity: item.quantity,
                            productAttributes: item.product.attributes.map((attr) => ({
                                id: attr.id,
                                name: attr.name,
                                type: attr.type,
                                selectedAttributes: item.selectedAttributes
                            }))
                        }))
                    }
                }
            });
            emptyCart();
            toast.success("Order placed successfully! 🎉", {
                closeOnClick: true,
            });
            closeOverlay();
        } catch (error) {
            toast.error(error.message || "Failed to place order. Please try again.", {
                closeOnClick: true,
                position: "bottom-right",
            });
        }
    }, [cartItems, addOrder, emptyCart, closeOverlay]);

    return (
        <>
            <div
                data-testid="cart-overlay"
                className={`cart-overlay overlay ${!cartOverlayOpen ? 'hidden' : ''}`}
                onClick={closeOverlay}
                role="presentation"
                aria-hidden={!cartOverlayOpen}
            />
            <div
                className={`my-bag overlay ${!cartOverlayOpen ? 'hidden' : ''}`}
                role="dialog"
                aria-modal="true"
                aria-label="Shopping cart"
                aria-hidden={!cartOverlayOpen}>
                <div className='my-bag-text'>
                    <span className='my-bag-title'>My Bag,</span>
                    <span className='my-bag-quantity'>
                        {cartItems.length} Item{cartItems.length === 1 ? "" : "s"}
                    </span>
                </div>
                <div className='cart-product-list'>
                    {cartItemsList}
                </div>
                <div className='total-price'>
                    <h5>Total</h5>
                    <div data-testid='cart-total'>
                        <h5>{totalPrice}</h5>
                        <h5>$</h5>
                    </div>
                </div>
                <button
                    disabled={cartItems.length === 0 || loading}
                    className={`cart-place-order-button ${loading ? 'loading' : ''}`}
                    onClick={handlePlaceOrder}
                    aria-busy={loading}>
                    {loading ? 'Processing...' : 'Place Order'}
                </button>
            </div>
        </>
    );
};

export default CartOverlay;