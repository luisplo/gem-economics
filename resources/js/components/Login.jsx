import { useState } from "react"
import { useNavigate } from "react-router";
import { toast } from "react-toastify";

export default function Login() {
    const [errors, setErrors] = useState(null)
    const [loadingSubmit, setLoadingSubmit] = useState(false)
    const [username, setUsername] = useState('')
    const [password, setPassword] = useState('')
    const navigate = useNavigate()

    const onSubmit = async () => {
        setLoadingSubmit(true)
        let success = false

        await axios.post('/api/login', {
            username,
            password
        }).then(res => {
            localStorage.setItem('access_token', res.data.access_token)
            localStorage.setItem('token_type', res.data.token_type)
            localStorage.setItem('user_name', res.data.name)
            localStorage.setItem('user_role', res.data.role.name)
            toast.success(`Welcome ${capitalizeFirstLetter(res.data.name)}`)
            success = true
        }).catch(error => {
            if (error.response && error.response.request.status == 422) {
                setErrors(error.response.data.errors)
            } else {
                toast.error('Error critical')
            }
        }).finally(() => {
            setLoadingSubmit(false)
            if (success) {
                navigate('/')
            }
        })
    }

    const capitalizeFirstLetter = (string) => {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    return (
        <div className="w-1/4 mx-auto">
            <div className="grid grid-cols-1 gap-4 ">
                <h1 className="font-semibold text-center text-4xl py-6">Login</h1>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text capitalize">username</span>
                    </label>
                    <input
                        name="username"
                        type="text"
                        value={username}
                        onChange={e => setUsername(e.target.value)}
                        className={`input input-bordered ${errors && errors.username ? 'input-error' : ''}`}
                        onKeyDown={(e) => {
                            const keyCode = e.key;
                            if (keyCode === 'Enter') onSubmit();
                        }} />
                    {errors && errors.username && (
                        (
                            <label className="label">
                                <span className="label-text-alt text-error">{errors.username}</span>
                            </label>
                        )
                    )}
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text capitalize">password</span>
                    </label>
                    <input
                        name="password"
                        type="password"
                        value={password}
                        onChange={e => setPassword(e.target.value)}
                        className={`input input-bordered ${errors && errors.password ? 'input-error' : ''}`}
                        onKeyDown={(e) => {
                            const keyCode = e.key;
                            if (keyCode === 'Enter') onSubmit();
                        }} />
                    {errors && errors.password && (
                        (
                            <label className="label">
                                <span className="label-text-alt text-error">{errors.password}</span>
                            </label>
                        )
                    )}
                </div>
                <button
                    onClick={onSubmit}
                    className={`uppercase font-bold btn ${loadingSubmit ? 'btn-disabled' : ''}`}
                >
                    Sign in
                    {loadingSubmit && (
                        <span className="loading loading-spinner loading-sm"></span>
                    )}
                </button>
            </div>
        </div>
    )
}
