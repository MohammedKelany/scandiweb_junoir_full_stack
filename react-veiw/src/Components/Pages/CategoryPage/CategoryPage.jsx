import { useMemo } from 'react';
import { useQuery } from "@apollo/client";
import Card from "../../Partials/Card/Card";
import { useStateContext } from "../../../contexts/ContextProvider";
import { GET_PRODUCTS } from "../../../graphql/queries";
import "./category_page.css";

export const CategoryPage = () => {
    const { selectedCategory } = useStateContext();
    const { loading: productsLoading, data: productsData } = useQuery(GET_PRODUCTS);

    const filteredProducts = useMemo(() => {
        if (productsLoading || !productsData?.products) return [];
        return productsData.products.filter(
            (product) => product.category.name === selectedCategory || selectedCategory === "all"
        );
    }, [productsLoading, productsData?.products, selectedCategory]);

    const productCards = useMemo(() => {
        return filteredProducts.map((product) => (
            <Card
                key={product.id}
                product={product}
            />
        ));
    }, [filteredProducts]);

    if (productsLoading) {
        return <div className="container">Loading products...</div>;
    }

    return (
        <div className='container'>
            <h2 className='category-title'>
                {selectedCategory}
            </h2>
            <div className='products-grid'>
                {productCards}
            </div>
        </div>
    );
};

export default CategoryPage;
