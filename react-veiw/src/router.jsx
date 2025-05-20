import { Navigate, createBrowserRouter } from 'react-router-dom'
import { Layout } from './Components/Layout/Layout';
import { CategoryPage } from './Components/Pages/CategoryPage';
import ProductDetails from './Components/Pages/ProductDetails/ProductDetails';


const router = createBrowserRouter([
    {
        path: "/",
        element: <Layout />,
        children: [
            {
                path: "/",
                element: <CategoryPage />,
                children: [
                    {
                        path: "/:categoryName",
                        element: <CategoryPage />,
                    }
                ]
            },
            {
                path: "/home",
                element: <Navigate to="/" />
            },
            {
                path: "/details/:productId",
                element: <ProductDetails />
            }
        ],
    }
]);

export default router