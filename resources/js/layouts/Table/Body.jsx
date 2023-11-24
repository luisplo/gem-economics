import DeleteOutlineOutlinedIcon from '@mui/icons-material/DeleteOutlineOutlined';
import EditOutlinedIcon from '@mui/icons-material/EditOutlined';
import CheckOutlinedIcon from '@mui/icons-material/CheckOutlined';
import axios from 'axios';
import { useGlobalDispatch } from '../../context/GlobalContext';
import { toast } from "react-toastify";

export default function LayoutBody({ data, module }) {

    const dispatch = useGlobalDispatch()

    const onDelete = async (item) => {
        let result = confirm(`Do you want to delete: ${item.name}?`)
        if (result) {
            await axios.delete(`/api/${module}/${item.id}`)
                .then(res => {
                    if (res && res.status == 200) {
                        toast.success('Successfully removed')
                        dispatch({ type: 'refresh', refresh: true })
                    }
                }).catch(() => {
                    toast.error('Something has gone wrong')
                })

        }
        return result;
    }

    const onComplete = async (item) => {
        let result = confirm(`Do you want to complete: ${item.name}?`)
        if (result) {
            await axios.get(`/api/${module}/complete/${item.id}`)
                .then(res => {
                    if (res && res.status == 201) {
                        toast.success('Successfully created')
                        dispatch({ type: 'refresh', refresh: true })
                    }
                }).catch(() => {
                    toast.error('Something has gone wrong')
                })

        }
        return result;
    }

    return data.map((item, index) => {
        return (

            <tr className="hover" key={index}>
                <th>{index + 1}</th>
                <td>
                    <button
                        className={`btn ${item.disabled ? 'btn-disabled' : ''}`}
                        onClick={() => onComplete(item)}
                    >
                        <CheckOutlinedIcon />
                    </button>
                </td>
                <td>{item.name}</td>
                <td>{item.description || '...'}</td>
                <td>{item.value}</td>
                <td>{item.intervals.name}</td>
                <td>{item.frequency}</td>
                <td>
                    <button
                        className='btn mr-5 btn-disabled'
                    >
                        < EditOutlinedIcon />
                    </button>
                    <button
                        className='btn'
                        onClick={() => onDelete(item)}
                    >
                        <DeleteOutlineOutlinedIcon />
                    </button>
                </td>
            </tr >
        )
    })
}
