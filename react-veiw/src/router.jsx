import { Navigate, createBrowserRouter } from 'react-router-dom'
import { Layout } from './Components/Layout/Layout';
import { CategoryPage } from './Components/Pages/CategoryPage/CategoryPage';
import ProductDetails from './Components/Pages/ProductDetails/ProductDetails';
import NotFoundPage from './Components/Pages/NotFoundPage/NotFoundPage';

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
            },
            {
                path: "*",
                element: <NotFoundPage />
            }
        ],
    }
]);

export default router