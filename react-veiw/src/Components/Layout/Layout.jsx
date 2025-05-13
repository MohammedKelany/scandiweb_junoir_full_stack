import React from 'react'
import { Outlet } from 'react-router-dom'
import CartOverlay from '../Pages/CartOverlay/CartOverlay'
import Header from './../Partials/Header/Header'

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
