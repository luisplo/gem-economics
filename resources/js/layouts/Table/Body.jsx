import DeleteOutlineOutlinedIcon from '@mui/icons-material/DeleteOutlineOutlined';
import EditOutlinedIcon from '@mui/icons-material/EditOutlined';
import CheckOutlinedIcon from '@mui/icons-material/CheckOutlined';
import { useGlobalDispatch } from '../../context/GlobalContext';

export default function LayoutBody({ data, module }) {
    const dispatch = useGlobalDispatch()

    const onDelete = (item) => {
        document.getElementById('my_modal').showModal()
        dispatch({
            type: 'modal',
            modal: {
                url: `/api/${module}/${item.id}`,
                action: 'delete',
                title: `Do you want to delete: ${item.name}?`,
                method: 'delete',
                module,
            }
        })
    }

    const onComplete = (item) => {
        document.getElementById('my_modal').showModal()
        dispatch({
            type: 'modal',
            modal: {
                url: `/api/${module}/complete/${item.id}`,
                action: 'complete',
                title: `Do you want to complete: ${item.name}?`,
                method: 'get',
                module,
            }
        })
    }

    return data && (data.map((item, index) => {
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
    }))
}
