import { useLocation } from 'react-router-dom';
import "./product_details.css";
import { useState } from 'react';
import ImageSlider from './../../Partials/Slider/ImageSlider';
import ProductAttributes from '../../Partials/ProductAttributes/ProductAttributes';
const ProductDetails = () => {
    const { state } = useLocation();
    const [currentIndex, setCurrentIndex] = useState(0);
    const product = state.product;
    return (
        <div className='container'>
            <div className="details-container"
                data-testid={`product-${product.name.replace(/\s+/g, '-').toLowerCase()}`} >
                <div
                    className="product-images"
                    data-testid='product-gallery'
                >
                    {product.gallery.map((image, index) =>
                        <img
                            style={{ border: currentIndex == index ? "2px solid var(--primary)" : "" }}
                            width="120"
                            height="100"
                            key={index} src={image} onClick={() => setCurrentIndex(index)} />
                    )}
                </div>
                <ImageSlider images={product.gallery} index={currentIndex} setter={setCurrentIndex} />
                <div className="product-details">
                    <ProductAttributes
                        className="product-details"
                        product={product}
                        isModalView={false}
                        cartItemId={product.id}
                    />
                </div>
            </div >
        </div >
    )
}

export default ProductDetails