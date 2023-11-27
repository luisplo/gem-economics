import Modal from "../layouts/Modal";
import LayoutTable from "../layouts/Table/Table";
import ModalCreate from "./ModalCreate";
import AddOutlinedIcon from '@mui/icons-material/AddOutlined';

export default function RewardsList() {
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
                module="rewards"
            />
            <ModalCreate
                title='create reward'
                action='create'
                module="rewards"
            />
            <Modal
                module="rewards"
            />
        </div>
    )
}

