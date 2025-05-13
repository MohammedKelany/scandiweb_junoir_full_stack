import { gql } from "@apollo/client";

export const ADD_ORDER = gql`
  mutation addOrder($input: OrderInput!) {
    addOrder(input: $input) {
      id
      total_price
    }
  }
`;
