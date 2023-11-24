import axios from "axios";
import { useEffect, useState } from "react";
import LayoutTable from "../layouts/Table/Table";
import ModalCreate from "./ModalCreate";
import AddOutlinedIcon from '@mui/icons-material/AddOutlined';
import { useGlobal, useGlobalDispatch } from "../context/GlobalContext";

export default function RewardsList() {
    const [data, setData] = useState(null)
    const context = useGlobal()
    const dispatch = useGlobalDispatch()

    const getData = async () => {
        dispatch({
            type:'loading',
            loading: true
        })
        await axios.get('/api/rewards').then(res => {
            setData(res.data)
        }).finally(() => {
            dispatch({
                type:'loading',
                loading: false
            })
        })
    }

    useEffect(() => {
        getData()
    }, [context.refresh])

    return (
        <div>
            <h1 className="flex justify-center pb-8 text-4xl font-semibold capitalize">rewards list</h1>
            <div className="flex justify-end  py-5">
                <button className="btn uppercase font-semibold" onClick={() => document.getElementById('modal_create_layout').showModal()}>
                    new
                    <AddOutlinedIcon />
                </button>
            </div>
            <LayoutTable
                data={data}
                module="rewards"
            />
            <ModalCreate
                title='create reward'
                action='create'
                module="rewards"
            />
        </div>
    )
}

