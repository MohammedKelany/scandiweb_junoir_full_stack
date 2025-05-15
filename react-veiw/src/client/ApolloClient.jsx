import { ApolloClient, InMemoryCache } from '@apollo/client';

console.log("server", `${import.meta.env.VITE_BASE_ENDPOINT}/graphql`);
export const client = new ApolloClient({
    uri: `${import.meta.env.VITE_BASE_ENDPOINT}/graphql`,
    cache: new InMemoryCache(),
});