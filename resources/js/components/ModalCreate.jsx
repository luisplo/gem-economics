import { useEffect, useState } from "react"
import { toast } from "react-toastify";
import { useGlobalDispatch } from "../context/GlobalContext";

export default function ModalCreate({ title, action, module }) {
    const [intervals, setIntervals] = useState(null)
    const [errors, setErrors] = useState(null)
    const [loadingSubmit, setLoadingSubmit] = useState(false)
    const dispatch = useGlobalDispatch()

    const fetchData = async () => {
        let { data } = await axios.get(`/api/intervals`)
        setIntervals(data)
    }

    useEffect(() => {
        fetchData()
    }, [])

    const clearSubmit = () => {
        document.getElementById("create-form").reset();
        setErrors(null)
    }

    const onSubmit = async (e) => {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const formJson = Object.fromEntries(formData.entries());
        setLoadingSubmit(true)

        dispatch({ type: 'refresh', refresh: true })

        await axios.post(`/api/${module}`, formJson).catch(error => {
            if (error.response.request.status == 422) {
                setErrors(error.response.data.errors)
            }
        }).then(res => {
            if (res && res.status == 201) {
                toast.success('Successfully created')
                clearSubmit()
                document.getElementById('modal_create_layout').close()
            }
        }).finally(() => {
            setLoadingSubmit(false)
        })
    }

    return (
        <dialog id="modal_create_layout" className="modal">
            <div className="modal-box">
                <form method="dialog">
                    <button onClick={clearSubmit} className="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 className="font-bold text-lg mb-6 capitalize">{title}</h3>
                <div className="grid grid-cols-1 gap-4 ">
                    <form id="create-form" onSubmit={onSubmit}>
                        <div className="form-control">
                            <label className="label">
                                <span className="label-text capitalize">Name</span>
                            </label>
                            <input id="name" name="name" type="text"
                                className={`input input-bordered ${errors && errors.name ? 'input-error' : ''}`} />
                            {errors && errors.name && (
                                (
                                    <label className="label">
                                        <span className="label-text-alt text-error">{errors.name}</span>
                                    </label>
                                )
                            )}
                        </div>
                        <div className="form-control">
                            <label className="label">
                                <span className="label-text capitalize">description</span>
                            </label>
                            <textarea id="description" name="description"
                                className={`textarea textarea-bordered h-24 ${errors && errors.description ? 'textarea-error' : ''}`} />
                            {errors && errors.description && (
                                (
                                    <label className="label">
                                        <span className="label-text-alt text-error">{errors.description}</span>
                                    </label>
                                )
                            )}
                        </div>
                        <div className="form-control ">
                            <label className="label">
                                <span className="label-text capitalize">gems</span>
                            </label>
                            <input id="value" name="value" type="number"
                                className={`input input-bordered ${errors && errors.value ? 'input-error' : ''}`} />
                            {errors && errors.value && (
                                (
                                    <label className="label">
                                        <span className="label-text-alt text-error">{errors.value}</span>
                                    </label>
                                )
                            )}
                        </div>
                        <div className="form-control">
                            <label className="label">
                                <span className="label-text capitalize">interval</span>
                            </label>
                            <select id="intervals_id" name="intervals_id"
                                className={`select select-bordered ${errors && errors.intervals_id ? 'select-error' : ''}`}>
                                {intervals && (
                                    intervals.map((item, index) => {
                                        return (<option key={index} value={item.id}>{item.name}</option>)
                                    })
                                )}
                            </select>
                            {errors && errors.intervals_id && (
                                (
                                    <label className="label">
                                        <span className="label-text-alt text-error">{errors.intervals_id}</span>
                                    </label>
                                )
                            )}
                        </div>
                        <div className="form-control">
                            <label className="label ">
                                <span className="label-text capitalize">interval frequency</span>
                            </label>
                            <input id="frequency" name="frequency" type="number"
                                className={`input input-bordered ${errors && errors.frequency ? 'input-error' : ''}`} />
                            {errors && errors.frequency && (
                                (
                                    <label className="label">
                                        <span className="label-text-alt text-error">{errors.frequency}</span>
                                    </label>
                                )
                            )}
                        </div>
                        <div className="modal-action">
                            <button
                                type="submit"
                                className={`uppercase font-bold btn ${loadingSubmit ? 'btn-disabled' : ''}`}
                            >
                                {action}
                                {loadingSubmit && (
                                    <span className="loading loading-spinner loading-sm"></span>
                                )}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
    )
}
