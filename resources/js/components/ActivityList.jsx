import Modal from "../layouts/Modal";
import LayoutTable from "../layouts/Table/Table";
import ModalCreate from "./ModalCreate";
import AddOutlinedIcon from '@mui/icons-material/AddOutlined';

export default function ActivityList() {
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
            />
            <ModalCreate
                title='create activity'
                action='create'
                module="activities"
            />
            <Modal
                module="activities"
            />
        </div>
    )
}

