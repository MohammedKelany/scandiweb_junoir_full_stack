import { NavLink, useParams } from 'react-router-dom'
import logoImg from "./../../../assets/logo.png"
import cartIcon from "./../../../assets/cart.png"
import { useQuery } from "@apollo/client"
import { useStateContext } from '../../../contexts/ContextProvider'
import { GET_CATEGORIES } from '../../../graphql/queries'
import "./header.css"
import { useCallback, useEffect, useMemo } from 'react'

const Header = () => {
    const { selectedCategory, setSelectedCategory, cartItems, cartOverlayOpen, setCartOverlayOpen } = useStateContext();
    const { loading: categoriesLoading, data: categoriesData } = useQuery(GET_CATEGORIES);

    // Get the category name from the URL On reload
    const { categoryName } = useParams();
    useEffect(() => {
        if (categoryName) {
            setSelectedCategory(categoryName);
        }
    }, []);

    const onCartIconClick = useCallback(() => {
        setCartOverlayOpen(!cartOverlayOpen);
        document.body.style.overflow = !cartOverlayOpen ? 'hidden' : '';
    }, [cartOverlayOpen, setCartOverlayOpen]);

    // Memoize categories to prevent unnecessary re-renders
    const categories = useMemo(() => {
        if (categoriesLoading || !categoriesData?.categories) return [];
        return categoriesData.categories.map((category) => (
            <NavLink
                key={category.name}
                data-testid={`${category.name === selectedCategory ? "active-" : ""}category-link`}
                to={`/${category.name}`}
                className={({ isActive }) =>
                    `header-nav-link ${isActive || category.name === selectedCategory ? "header-navs-active" : ""}`
                }
                onClick={() => setSelectedCategory(category.name)}
                aria-current={category.name === selectedCategory ? "page" : undefined}>
                {category.name}
            </NavLink>
        ));
    }, [categoriesLoading, categoriesData, selectedCategory, setSelectedCategory]);

    // Memoize cart badge to prevent unnecessary re-renders
    const cartBadge = useMemo(() => {
        if (cartItems.length === 0) return null;
        return (
            <div
                className='cart-number'
                role="status"
                aria-label={`${cartItems.length} items in cart`}>
                {cartItems.length}
            </div>
        );
    }, [cartItems.length]);

    return (
        <header className="header" role="banner">
            <div className='container header-container'>
                <nav className='header-navs' role="navigation" aria-label="Main navigation">
                    {categoriesLoading ? (
                        <div className="header-nav-loading" aria-hidden="true">
                        </div>
                    ) : (
                        categories
                    )}
                </nav>
                <div className="header-logo-container">
                    <NavLink to="/" aria-label="Home">
                        <img
                            src={logoImg}
                            className='header-logo'
                            alt='Scandiweb Logo'
                            width="41"
                            height="41"
                            loading="eager"
                        />
                    </NavLink>
                </div>
                <button
                    data-testid='cart-btn'
                    className='cart-button'
                    onClick={onCartIconClick}
                    aria-label="Open shopping cart"
                    aria-expanded={cartOverlayOpen}>
                    <img
                        src={cartIcon}
                        className='cart-icon'
                        alt=''
                        width="20"
                        height="20"
                        loading="eager"
                    />
                    {cartBadge}
                </button>
            </div>
        </header>
    )
}

export default Header