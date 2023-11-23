import LayoutHeader from "./Header";
import Loader from "../../components/Loader";
import LayoutBody from "./Body";
import { useGlobal } from "../../context/GlobalContext";
import Modal from "../Modal";

export default function LayoutTable({ data, module }) {
    const context = useGlobal()
    return (
        <div>
            <table className="table">
                <thead>
                    <LayoutHeader />
                </thead>
                <tbody>
                    {data && (
                        <LayoutBody
                            data={data}
                            module={module}
                        />
                    )}
                </tbody>
            </table>
            {context.loading && (
                <Loader />
            )}
            <Modal />
        </div>
    )
}
