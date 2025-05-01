import React, { useEffect, useRef } from 'react'
import "./cart_overlay.css";

const CartOverlay = () => {
    const overlayRef = useRef();
    const cartRef = useRef();

    const closeOverlay = () => {
        overlayRef.current.style.display = "none";
        cartRef.current.style.display = "none";
    }

    const cartList = [
        {
            title: "Running Short",
            price: "50.00$",
            image: "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            sizes: ["XL", "L", "M", "S"],
            quantity: 0,
            colors: ["red", "green", "#666", "#555"],
        },
        {
            title: "Running Short",
            price: "50.00$",
            quantity: 0,
            image: "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            sizes: ["XL", "L", "M", "S"],
            colors: ["#444", "#777", "#666", "#555"],
        },
        {
            title: "Running Short",
            price: "50.00$",
            quantity: 0,
            image: "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            sizes: ["XL", "L", "M", "S"],
            colors: ["#444", "#777", "#666", "#555"],
        }
    ];

    return (
        <>
            <div className='overlay-container overlay' ref={overlayRef} onClick={() => closeOverlay()}>
            </div>
            <div className='my-bag overlay' ref={cartRef}>
                <div className='my-bag-text'>
                    <span className='my-bag-title'>My Bag,</span>
                    &nbsp;
                    <span className='my-bag-quantity'>3 Items</span>
                </div>
                <div className='cart-product-list'>
                    {cartList.map((cartItem, index) => (
                        <div className='cart-product' key={index}>
                            <div className='cart-product-properties' >
                                <div className='cart-product-title'>{cartItem.title}</div>
                                <div className='cart-product-price'>{cartItem.price}</div>
                                <div className='size-text'>Size:</div>
                                <div className='cart-product-sizes'>
                                    {cartItem.sizes.map((size) => (
                                        <button className='cart-size' key={size}>
                                            {size}
                                        </button>
                                    ))}
                                </div>
                                <div className='color-text'>Color:</div>
                                <div className='cart-product-colors'>
                                    {cartItem.colors.map((color) => (
                                        <div className='cart-product-color' key={color} style={{ backgroundColor: color }} />
                                    ))}
                                </div>
                            </div>
                            <div className='cart-product-properties'>
                                <div className='cart-product-quantity'>
                                    <button className='add-button'>+</button>
                                    <span className='quantity-text'>{cartItem.quantity}</span>
                                    <button className='minus-button'>-</button>
                                </div>
                                <img className='cart-product-image' src={cartItem.image} alt="Cart Image" />
                            </div>
                        </div>
                    ))}
                </div>
                <div className='total-price'>
                    <h5>Total</h5>
                    <h5>200$</h5>
                </div>
                <button className='cart-place-order-button'>Place Order</button>
            </div>
        </>

    )
}

export default CartOverlay