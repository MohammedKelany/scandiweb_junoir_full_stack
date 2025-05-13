import React from 'react'
import "./card.css"
import { Link } from 'react-router-dom'
import cartIcon from "./../../../assets/cart.png";
import { useStateContext } from '../../../contexts/ContextProvider';


const Card = (props) => {
    const { addToCart } = useStateContext()

    return (
        <div className='product-card'>
            <Link
                style={{ opacity: props.product.inStock ? 1 : .7 }}
                data-testid={`product-${props.product.name.replace(/\s+/g, '-')}`}
                className='product-link' to={`/details/${props.product.id}`}
                state={{ product: props.product }
                }>
                <div style={{ backgroundImage: `url(${props.product.gallery[0]})` }} className='product-img' alt="Product" >
                    {props.product.inStock ? "" : "Out of Stock"}
                </div>
                <h4 className='product-title'>{props.product.name}</h4>
                <h5 className='product-price'>{props.product.prices[0].amount + props.product.prices[0].currency.symbol}</h5>
            </Link >
            <button
                className='quick-cart-button'
                disabled={!props.product.inStock}
                onClick={() => addToCart(props.product)}
                style={{
                    backgroundColor: `${props.product.inStock ? "var(--primary-hover)" : "#e6e6e6f3"}`,
                }}>
                <img src={cartIcon} alt='Cart Icon' />
            </button>
        </div>

    )
}

export default Card