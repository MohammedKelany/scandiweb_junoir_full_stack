import Card from "../Partials/Card/Card"
import { useStateContext } from "../../contexts/ContextProvider";
import { useQuery } from "@apollo/client"
import { GET_PRODUCTS } from "../../graphql/queries";


export const CategoryPage = () => {
    const { selectedCategory } = useStateContext();
    const { loading: productsLoading, data: productsData, error: productsError } = useQuery(GET_PRODUCTS);
    // console.log(productsData);
    return (
        <div className='container'>
            <h2 className='category-title'>
                {selectedCategory}
            </h2>
            <div className='products-grid'>
                {
                    productsLoading ?
                        <div>
                        </div>
                        :
                        productsData["products"].filter((product) => product.category.name == selectedCategory || selectedCategory == "all").map(
                            (product) => < Card
                                key={product.id}
                                product={product}
                            />
                        )}
            </div>
        </div>
    )
}
