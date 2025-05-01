import React from 'react'
import { Outlet } from 'react-router-dom'
import Header from './Components/Header'
import CartOverlay from './Components/CartOverlay/CartOverlay'

export const Layout = () => {
    return (
        <>
            <Header />
            <CartOverlay />
            <div className="page-content">
                <Outlet />
            </div>
        </>
    )
}
