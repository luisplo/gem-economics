import LayoutHeader from "./Header";
import LayoutBody from "./Body";
import { useGlobal, useGlobalDispatch } from "../../context/GlobalContext";
import { useEffect, useState } from "react";
import axios from "axios";
import Loader from "../../components/Loader";


export default function LayoutTable({ module }) {
    const context = useGlobal()
    const dispatch = useGlobalDispatch()
    const [loading, setLoading] = useState(false)

    const getData = () => {
        if (context[`initial_${module}`]) {
            setLoading(true)
            axios.get(`/api/${module}`).then(res => {
                dispatch({
                    type: module,
                    [module]: res.data
                })
            }).finally(() => {
                setLoading(false)
            })
        }
    }

    useEffect(() => {
        getData()
    }, [context[module]])

    return (
        <div>

            <table className="table">
                <thead>
                    <LayoutHeader />
                </thead>
                <tbody>
                    <LayoutBody
                        data={context[module]}
                        module={module}
                    />
                </tbody>
            </table>
            <Loader loading={loading} />
        </div>
    )
}
