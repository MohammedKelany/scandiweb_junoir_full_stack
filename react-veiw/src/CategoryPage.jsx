import Card from "./Components/Card/Card"
import { useStateContext } from "./contexts/ContectProvider";

export const CategoryPage = () => {
    const { navFlag } = useStateContext();
    return (
        <div className='container'>
            <h2 className='category-title'>
                {navFlag}
            </h2>
            <div className='products-grid'>
                <Card />
                <Card />
                <Card />
                <Card />
                <Card />
            </div>
        </div>
    )
}
