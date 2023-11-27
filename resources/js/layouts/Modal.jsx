import axios from "axios"
import { useGlobal, useGlobalDispatch } from "../context/GlobalContext"
import { toast } from "react-toastify"
import { useState } from "react"

export default function Modal() {
    const context = useGlobal()
    const dispatch = useGlobalDispatch()
    const [loadingSubmit, setLoadingSubmit] = useState(false)

    const onSubmit = () => {
        setLoadingSubmit(true)
        axios[context.modal.method](context.modal.url)
            .then(res => {
                if (res && res.status == 201) {
                    dispatch({
                        type: 'update-list-disabled',
                        module: context.modal.module,
                        [context.modal.module]: res.data[0]
                    })
                } else if (res && res.status == 200 && context.modal.method == 'delete') {
                    dispatch({
                        type: 'update-list-delete',
                        module: context.modal.module,
                        [context.modal.module]: res.data
                    })
                }
                toast.success(`Successfully ${context.modal.action}`)
            })
            .catch(() => {
                toast.error('Something has gone wrong')
            }).finally(() => {
                setLoadingSubmit(false)
                document.getElementById('my_modal').close()
            })
    }

    return (
        <dialog id="my_modal" className="modal">
            <div className="modal-box">
                <form method="dialog">
                    <button className="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 className="font-bold text-lg">{context.modal.title}</h3>
                <div className="modal-action">
                    <button
                        className="btn uppercase font-bold"
                        onClick={onSubmit}
                    >
                        {context.modal.action}
                        {loadingSubmit && (
                            <span className="loading loading-spinner loading-sm"></span>
                        )}
                    </button>
                </div>
            </div>
        </dialog>
    )
}
