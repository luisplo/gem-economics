import { useGlobal, useGlobalDispatch } from "../context/GlobalContext"

export default function Modal() {
    const context = useGlobal()
    const dispatch = useGlobalDispatch()

    return (
        <dialog id="my_modal" className="modal">
            <div className="modal-box">
                <form method="dialog">
                    <button className="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 className="font-bold text-lg">{context.modal.title}</h3>
                <div className="modal-action">
                    <button
                        className="btn"
                        onClick={() => dispatch({ type: 'modal-confirm', confirm: true })}
                    >
                        {context.modal.button}
                    </button>
                </div>
            </div>
        </dialog>
    )
}
