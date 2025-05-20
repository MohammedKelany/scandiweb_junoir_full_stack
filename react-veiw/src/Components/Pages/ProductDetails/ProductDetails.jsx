import { useParams } from 'react-router-dom';
import "./product_details.css";
import { useState, useMemo } from 'react';
import ImageSlider from './../../Partials/Slider/ImageSlider';
import ProductAttributes from '../../Partials/ProductAttributes/ProductAttributes';
import { GET_SINGLE_PRODUCT } from '../../../graphql/queries';
import { useQuery } from '@apollo/client';

const ProductDetails = () => {
    const { productId } = useParams();
    const [currentIndex, setCurrentIndex] = useState(0);

    const { data: productData, loading: productLoading } = useQuery(GET_SINGLE_PRODUCT, {
        variables: { id: productId },
        skip: !productId
    });

    const galleryImages = useMemo(() => {
        if (!productData?.product?.gallery) return [];
        return productData.product.gallery.map((image, index) => (
            <img
                key={index}
                style={{ border: currentIndex === index ? "2px solid var(--primary)" : "" }}
                width="120"
                height="100"
                src={image}
                onClick={() => setCurrentIndex(index)}
                alt={`Product view ${index + 1}`}
                loading={index === 0 ? "eager" : "lazy"}
            />
        ));
    }, [productData?.product?.gallery, currentIndex]);

    const productDetails = useMemo(() => {
        if (!productData?.product) return null;
        return (
            <div className="product-details">
                <ProductAttributes
                    className="product-details"
                    product={productData.product}
                    isModalView={false}
                    cartItemId={productData.product.id}
                />
            </div>
        );
    }, [productData?.product]);

    const imageSlider = useMemo(() => {
        if (!productData?.product?.gallery) return null;
        return (
            <ImageSlider
                images={productData.product.gallery}
                index={currentIndex}
                setter={setCurrentIndex}
            />
        );
    }, [productData?.product?.gallery, currentIndex]);

    if (productLoading) {
        return <div className="container">Loading product details...</div>;
    }

    if (!productData?.product) {
        return <div className="container">Product not found</div>;
    }

    return (
        <div className='container'>
            <div
                className="details-container"
                data-testid={`product-${productData.product.name.replace(/\s+/g, '-').toLowerCase()}`}
            >
                <div
                    className="product-images"
                    data-testid='product-gallery'
                >
                    {galleryImages}
                </div>
                {imageSlider}
                {productDetails}
            </div>
        </div>
    );
};

export default ProductDetails;