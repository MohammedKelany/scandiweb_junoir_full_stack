import React from 'react'
import "./card.css"
import { Link, Navigate } from 'react-router-dom'

const Card = () => {

    return (
        <Link className='product-card' to={`/details/${1}`}>
            <div className='product-img' alt="Product" >
                Out of Stock
            </div>
            <h4 className='product-title'>Running Short</h4>
            <h5 className='product-price'>50.00$</h5>
        </Link>
    )
}

export default Card