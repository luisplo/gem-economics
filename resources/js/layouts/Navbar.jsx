import { Link, useNavigate } from "react-router-dom";
import PersonOutlinedIcon from '@mui/icons-material/PersonOutlined';
import { toast } from "react-toastify";

export default function Navbar() {
    const userName = localStorage.getItem('user_name') || 'User';
    const userRole = localStorage.getItem('user_role') || 'Role';
    const token = localStorage.getItem('access_token') || null;

    const navigate = useNavigate()

    const logout = () => {
        localStorage.clear()
        toast.success(`Goodbye ${userName}`)
        navigate('/login')
    }

    return (
        <div className="navbar shadow">
            <div className="navbar-start">
                <Link className="text-xl font-bold mx-3 my-auto capitalize" to={'/'}>Gem economics</Link>
            </div>

            <div className={`navbar-center ${!token ? 'hidden' : ''}`}>
                <ul className="menu menu-horizontal px-1">
                    <li className="capitalize font-semibold text-md"><Link to={'/activities'}>activities</Link></li>
                    <li className="capitalize font-semibold text-md"><Link to={'/rewards'}>rewards</Link></li>
                </ul>
            </div>

            <div className={`navbar-end ${!token ? 'hidden' : ''}`}>
                <span className="capitalize font-semibold text-md justify-between">
                    {userName}
                    <span className="badge badge-accent badge-outline ml-2">{userRole}</span>
                </span>

                <div className="dropdown dropdown-end ml-4">
                    <div tabIndex="0" role="button" className="avatar placeholder btn btn-ghost btn-circle ">
                        <div className="bg-neutral text-neutral-content rounded-full w-10">
                            <PersonOutlinedIcon />
                        </div>
                    </div>
                    <ul tabIndex="0" className="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-30">
                        <li hidden><a>Settings</a></li>
                        <li><a onClick={logout}>Logout</a></li>
                    </ul>
                </div>

            </div>
        </div>
    )
}
