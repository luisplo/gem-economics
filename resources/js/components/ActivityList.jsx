import axios from "axios";
import { useEffect, useState } from "react";
import LayoutTable from "../layouts/Table/Table";
import ModalCreate from "./ModalCreate";
import AddOutlinedIcon from '@mui/icons-material/AddOutlined';
import { useGlobal, useGlobalDispatch } from "../context/GlobalContext";
const url = import.meta.env.VITE_APP_URL;

export default function ActivityList() {
    const [data, setData] = useState(null)
    const context = useGlobal()
    const dispatch = useGlobalDispatch()

    const getData = async () => {
        dispatch({
            type:'loading',
            loading: true
        })
        await axios.get(`${url}/api/activities`).then(res => {
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
            <h1 className="flex justify-center pb-8 text-4xl font-semibold capitalize">activities list</h1>
            <div className="flex justify-end py-5">
                <button className="btn font-bold uppercase" onClick={() => document.getElementById('modal_create_layout').showModal()}>
                    new
                    <AddOutlinedIcon />
                </button>
            </div>
            <LayoutTable
                module='activities'
                data={data}
            />
            <ModalCreate
                title='Registrar actividad'
                action='Guardar'
                module="activities"
            />
        </div>
    )
}

