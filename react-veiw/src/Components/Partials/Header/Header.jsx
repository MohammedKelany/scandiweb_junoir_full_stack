import { NavLink } from 'react-router-dom'
import logoImg from "./../../../assets/logo.png"
import cartIcon from "./../../../assets/cart.png"
import { useQuery } from "@apollo/client"
import { useStateContext } from '../../../contexts/ContextProvider'
import { GET_CATEGORIES } from '../../../graphql/queries'
import "./header.css"

const Header = () => {
    const { selectedCategory } = useStateContext();
    const { setSelectedCategory, cartItems } = useStateContext();
    const { loading: categoriesLoading, data: categoriesData, error: categoriesError } = useQuery(GET_CATEGORIES);

    const onCartIconClick = () => {
        const overlay = document.querySelectorAll(".overlay");
        overlay.forEach((element) => {
            if (element.style.display === "none" || element.style.display === "") {
                element.style.display = "flex";
            } else {
                element.style.display = "none";
            }
        });
    }
    return (
        <div className="header">
            <header className='container'>
                <nav className='header-navs'>
                    {
                        categoriesLoading ? <div>
                            loading ...
                        </div> :
                            categoriesData["categories"].map((category) =>
                                <NavLink
                                    data-testid={`${category.name == selectedCategory ? "" : "active-"}category-link`}
                                    to={`/`} className={() =>
                                        (category.name == selectedCategory ? "header-navs-active" : "header-navs")
                                    } key={category.name} onClick={() => setSelectedCategory(category.name)}>
                                    {category.name}
                                </NavLink>
                            )}
                </nav>
                <img src={logoImg} className='header-logo' alt='LOGO' />
                <button data-testid='cart-btn' className='cart' onClick={() => onCartIconClick()}>
                    <img src={cartIcon} className='cart-icon' alt='Cart Icon' />
                    {
                        cartItems.length > 0 && <div className='cart-number'>
                            {cartItems.length}
                        </div>
                    }

                </button>
            </header>
        </div>

    )
}

export default Header