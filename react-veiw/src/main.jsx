import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import { RouterProvider } from 'react-router-dom'
import router from './router'
import { ContextProvider } from './contexts/ContextProvider'
import { ApolloProvider, gql } from '@apollo/client';
import { client } from './client/ApolloClient'
import { ToastContainer } from 'react-toastify'




createRoot(document.getElementById('root')).render(
  <StrictMode>
    <ApolloProvider client={client}>
      <ContextProvider >
        <RouterProvider router={router} />
        <ToastContainer />
      </ContextProvider>
    </ApolloProvider>
  </StrictMode>,
)
