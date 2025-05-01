import { useState } from 'react'
import { NavLink } from 'react-router-dom'
import logoImg from "./../assets/logo.png"
import cartIcon from "./../assets/cart.png"
import { useStateContext } from '../contexts/ContectProvider'

const Header = () => {
    const { setNavFlag } = useStateContext();
    const flags = ["Women", "Men", "Kids"];
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
                        flags.map((flag) =>
                            <NavLink className="header-navs" key={flag} onClick={() => setNavFlag(flag)}>
                                {flag}
                            </NavLink>
                        )}
                </nav>
                <img src={logoImg} className='header-logo' alt='LOGO' />
                <div className='cart' onClick={() => onCartIconClick()}>
                    <img src={cartIcon} className='cart-icon' alt='Cart Icon' />
                    <div className='cart-number'>
                        1
                    </div>
                </div>
            </header>
        </div>

    )
}

export default Header