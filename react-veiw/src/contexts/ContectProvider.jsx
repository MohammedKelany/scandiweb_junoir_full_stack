import { createContext, useContext, useState } from "react";


const StateContext = createContext({
    navFlag: "Women",
    setNavFlag: () => { },
});

export const ContextProvider = ({ children }) => {
    const [navFlag, setNavFlag] = useState("Women");
    return (<StateContext.Provider value={{
        navFlag,
        setNavFlag
    }}>
        {children}
    </StateContext.Provider>)
}

export const useStateContext = () => useContext(StateContext);