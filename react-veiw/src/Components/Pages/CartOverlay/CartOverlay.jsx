import { useMutation } from '@apollo/client';
import { useRef } from 'react';
import { ADD_ORDER } from "../../../graphql/mutations";
import { useStateContext } from '../../../contexts/ContextProvider';
import ProductAttributes from './../../Partials/ProductAttributes/ProductAttributes';
import "./cart_overlay.css";
import { toast } from 'react-toastify';

const CartOverlay = () => {
    const { updateCartItemQuantity, cartItems, emptyCart, totalPrice } = useStateContext()
    const overlayRef = useRef();
    const cartRef = useRef();
    const [addOrder, { loading: orderLoading, data: orderData, error: orderError }] = useMutation(ADD_ORDER)
    const closeOverlay = () => {
        overlayRef.current.style.display = "none";
        cartRef.current.style.display = "none";
    }

    return (
        <>
            <div className='overlay-container overlay' ref={overlayRef} onClick={() => closeOverlay()}>
            </div>
            <div className='my-bag overlay' ref={cartRef}>
                {<>
                    <div className='my-bag-text'>
                        <span className='my-bag-title'>My Bag,</span>
                        &nbsp;
                        <span className='my-bag-quantity'>{cartItems.length} Item{cartItems.length == 1 ? "" : "s"}</span>
                    </div>
                    <div className='cart-product-list'>
                        {
                            cartItems.map((cartItem, index) => (
                                <div className='cart-product' key={index}>
                                    <div className='cart-product-properties' >
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
                                                onClick={
                                                    () => updateCartItemQuantity(
                                                        cartItem.product.id,
                                                        cartItem.quantity,
                                                        "add", cartItem.id
                                                    )}>+</button>
                                            <span
                                                data-testid='cart-item-amount'
                                                className='quantity-text'>
                                                {cartItem.quantity}
                                            </span>
                                            <button
                                                data-testid='cart-item-amount-decrease'
                                                className='minus-button'
                                                onClick={
                                                    () => updateCartItemQuantity(
                                                        cartItem.product.id, cartItem.quantity,
                                                        "minus",
                                                        cartItem.id
                                                    )}>-</button>
                                        </div>
                                        <div className='cart-product-image-container'>
                                            <img
                                                className='cart-product-image'
                                                src={cartItem.product.gallery[0]}
                                                alt="Cart Image"
                                            />
                                        </div>
                                    </div>
                                </div>
                            ))}
                    </div>
                    <div className='total-price'>
                        <h5>Total</h5>
                        <div
                            data-testid='cart-total'>
                            <h5>{totalPrice}</h5>
                            <h5> $</h5>
                        </div>
                    </div>
                    <button
                        disabled={cartItems.length == 0}
                        style={{
                            backgroundColor: cartItems.length == 0 ? "var(--disabled-color)" : "var(--primary)"
                        }}
                        onClick={
                            () => cartItems.length > 0
                                ?
                                addOrder(
                                    {
                                        variables: {
                                            input: {
                                                items: cartItems.map(item => {
                                                    return {
                                                        productId: item.product.id,
                                                        quantity: item.quantity,
                                                        productAttributes: item.product.attributes.map((attr) => {
                                                            return {
                                                                id: attr.id,
                                                                name: attr.name,
                                                                type: attr.type,
                                                                selectedAttributes: item.selectedAttributes
                                                            }
                                                        })
                                                    }
                                                }
                                                )
                                            }
                                        }
                                    }).then(() => {
                                        emptyCart();
                                        toast.success("Ordered is Placed Successfully !!!", {
                                            closeOnClick: true,
                                        })
                                    }).catch((error) => toast.error(error.message, {
                                        closeOnClick: true,
                                        position: "bottom-right",
                                    }))
                                :
                                toast.error("Please Select some products !!!", {
                                    closeOnClick: true,
                                    position: "bottom-right",
                                })
                        } className='cart-place-order-button'>Place Order</button>
                </>
                }


            </div >
        </>

    )
}

export default CartOverlay