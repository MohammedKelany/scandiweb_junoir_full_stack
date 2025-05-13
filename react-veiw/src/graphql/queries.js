import { gql } from "@apollo/client";

export const GET_CATEGORIES = gql`
  query {
    categories {
      name
    }
  }
`;

const getProductFields = gql`
    id
    name
    inStock
    gallery
    description
    brand
    prices {
      amount
      currency {
        label
        symbol
      }
    }
    category {
      name
    }
    attributes {
      id
      name
      type
      items {
        id
        value
        displayValue
        attributeName
      }
    }
`;
export const GET_ORDER_PRODUCTS = gql`
  query getOrders {
    orders {
      id
      total_price
      created_at
      __typename
      products {
        product_id
        quantity
        __typename
        product_attributes {
          id
          name
          type
          __typename
          selectedAttributes {
            id
            attributeName
            value
            __typename
          }
        }
      }
    }
  }
`;

export const GET_PRODUCTS = gql`
  query{
    products{
      ${getProductFields}
    }
  }
`;

export const GET_SINGLE_PRODUCT = gql`
  query ($id: String!) {
    product(id: $id) {
      ${getProductFields}
    }
  }
`;

export const GET_CATEGORIES_AND_PRODUCTS = gql`
  query ($category: String) {
    categories {
      name
    }
    products(category: $category) {
      ${getProductFields}
    }
  }
`;
