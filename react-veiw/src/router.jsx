import { Navigate, createBrowserRouter } from 'react-router-dom'
import { Layout } from './Layout';
import { CategoryPage } from './CategoryPage';
import ProductDetails from './Components/ProductDetails/ProductDetails';


const router = createBrowserRouter([
    {
        path: "/",
        element: <Layout />,
        children: [
            {
                path: "/",
                element: <CategoryPage />
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