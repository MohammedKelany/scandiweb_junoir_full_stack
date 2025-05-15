import { createContext, useContext, useEffect, useState } from "react";
import { toast } from "react-toastify";

const StateContext = createContext({
    productsData: [],
    cartItems: [],
    selectedCategory: "all",
    totalPrice: 0,
    setProductsData: () => { },
    setSelectedCategory: () => { },
    addToCart: () => { },
    updateCartItemQuantity: () => { },
    updateCartItemAttribute: () => { },
    emptyCart: () => { },
});

export const ContextProvider = ({ children }) => {
    const [productsData, setProductsData] = useState([]);
    const [cartItems, setCartItems] = useState(() => {
        return JSON.parse(localStorage.getItem("cartItems")) || [];
    });
    const [selectedCategory, setSelectedCategory] = useState("all");
    const [totalPrice, setTotalPrice] = useState(0);

    // Save cart to localStorage and recalculate total on any change
    useEffect(() => {
        localStorage.setItem("cartItems", JSON.stringify(cartItems));
        const total = cartItems.reduce((acc, item) => {
            return acc + item.product.prices[0].amount * item.quantity;
        }, 0);
        setTotalPrice(Number(total.toFixed(2)));
    }, [cartItems]);

    const addToCart = (product = {}, shouldProvideAttributes = false, selectedAttributes = []) => {
        let attributes;

        if (shouldProvideAttributes) {
            const missing = product.attributes.filter(
                (attr) => !selectedAttributes.some((a) => a.attributeName === attr.name)
            );
            if (missing.length > 0) {
                return toast.error("Please select all attributes! ⚠️", {
                    closeOnClick: true,
                });
            }

            attributes = selectedAttributes.map(({ id, attributeName, value }) => ({
                id,
                attributeName,
                value,
            }));
        } else {
            attributes = product.attributes?.map((attr) => ({
                id: attr.items[0].id,
                attributeName: attr.name,
                value: attr.items[0].value,
            })) || [];
        }

        const newCart = [...cartItems];
        const existingIndex = newCart.findIndex(
            (item) =>
                item.product.id === product.id &&
                JSON.stringify(item.selectedAttributes) === JSON.stringify(attributes)
        );

        if (existingIndex !== -1) {
            newCart[existingIndex].quantity += 1;
        } else {
            newCart.unshift({
                id: Date.now(),
                product,
                selectedAttributes: attributes,
                quantity: 1,
            });
        }

        setCartItems(newCart);
        toast.success("Item added to cart! 🛒", {
            closeOnClick: true,
        });
    };

    const updateCartItemAttribute = (cartItemId, newAttributes) => {
        const updatedCart = [...cartItems];
        const itemIndex = updatedCart.findIndex((item) => item.id === cartItemId);
        if (itemIndex === -1) return;

        const product = updatedCart[itemIndex].product;

        const duplicateIndex = updatedCart.findIndex(
            (item, idx) =>
                idx !== itemIndex &&
                item.product.id === product.id &&
                JSON.stringify(item.selectedAttributes) === JSON.stringify(newAttributes)
        );

        if (duplicateIndex !== -1) {
            updatedCart[duplicateIndex].quantity += updatedCart[itemIndex].quantity;
            updatedCart.splice(itemIndex, 1);
            toast.success("Cart items merged successfully!", {
                closeOnClick: true,
            });
        } else {
            updatedCart[itemIndex].selectedAttributes = newAttributes;
            toast.success("Cart item attribute updated successfully!", {
                closeOnClick: true,
            });
        }

        setCartItems(updatedCart);
    };

    const updateCartItemQuantity = (productId, value, action = null, itemId) => {
        const updatedCart = [...cartItems];
        const index = updatedCart.findIndex(
            (item) => item.product.id === productId && item.id === itemId
        );

        if (index === -1) return;

        if (action === "add") {
            updatedCart[index].quantity += 1;
        } else if (action === "minus") {
            updatedCart[index].quantity -= 1;
        } else {
            updatedCart[index].quantity += value;
        }

        if (updatedCart[index].quantity <= 0) {
            updatedCart.splice(index, 1);
        }

        setCartItems(updatedCart);
        toast.success("Cart item quantity updated successfully!", {
            closeOnClick: true,
        });
    };

    const emptyCart = () => {
        setCartItems([]);
        localStorage.removeItem("cartItems");
    };

    return (
        <StateContext.Provider
            value={{
                productsData,
                cartItems,
                selectedCategory,
                totalPrice,
                setProductsData,
                setSelectedCategory,
                addToCart,
                updateCartItemQuantity,
                updateCartItemAttribute,
                emptyCart,
            }}
        >
            {children}
        </StateContext.Provider>
    );
};

export const useStateContext = () => useContext(StateContext);
