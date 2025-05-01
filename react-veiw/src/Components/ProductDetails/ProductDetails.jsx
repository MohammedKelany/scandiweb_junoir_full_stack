import { useParams } from 'react-router-dom';
import "./product_details.css";
import { useState } from 'react';

const ProductDetails = () => {
    const { productId } = useParams();
    const [currentIndex, setCurrentIndex] = useState(0);
    const showPrev = () => {
        setCurrentIndex((prevIndex) => {
            if (prevIndex == 0) return product.images.length - 1;
            return prevIndex - 1;
        });
    }
    const showNext = () => {
        setCurrentIndex((prevIndex) => {
            if (prevIndex == product.images.length - 1) return 0;
            return prevIndex + 1;
        });
    }
    const product = {
        images: [
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
        ],
        title: "Running Short",
        price: "50.00$",
        sizes: ["XL", "L", "M", "S"],
        quantity: 0,
        colors: ["red", "green", "#666", "#555"],
        description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis iusto nemo laboriosam tenetur sapiente exercitationem voluptatibus deleniti aspernatur cumque obcaecati, enim placeat eius quisquam esse dignissimos porro laudantium. Blanditiis, architecto."

    }
    return (
        <div className='container'>
            <div className="details-container">
                <div className="product-images">
                    {product.images.map((image, index) =>
                        <img
                            style={{ border: currentIndex == index ? "2px solid var(--primary)" : "" }}
                            width="120" height="100"
                            key={index} src={image} onClick={() => setCurrentIndex(index)} />
                    )}
                </div>
                <div className="slider">
                    <div className="images">
                        {
                            product.images.map((image, index) =>
                                <img key={index} src={image} style={{ translate: `${-100 * currentIndex}%` }} />
                            )}
                    </div>
                    <button className='backward btn-slider' onClick={() => showPrev()}>⬅</button>
                    <button className='forward btn-slider' onClick={() => showNext()}>➡</button>
                </div>
                <div className="product-details">
                    <div className='product-title'>{product.title}</div>
                    <div className='size-text'>Size:</div>
                    <div className='product-sizes'>
                        {product.sizes.map((size) => (
                            <button className='size' key={size}>
                                {size}
                            </button>
                        ))}
                    </div>
                    <div className='color-text'>Color:</div>
                    <div className='product-colors'>
                        {product.colors.map((color) => (
                            <div className='product-color' key={color} style={{ backgroundColor: color }} />
                        ))}
                    </div>
                    <div className='price-text'>Price: </div>
                    <div className='product-price'>{product.price}</div>
                    <button className='place-order-button'>Place Order</button>
                    <div className='product-description'>
                        {product.description}
                    </div>
                </div>
            </div>
        </div>
    )
}

export default ProductDetails