import { Link } from "react-router-dom";
const AppName = import.meta.env.VITE_APP_NAME;

export default function Navbar() {
    return (
        <div className="navbar shadow">
            <div className="flex-1">
                <Link className="text-xl font-bold mx-3 my-auto capitalize" to={'/'}>{AppName}</Link>
            </div>
            <div className="flex-none">
                <ul className="menu menu-horizontal px-1">
                    <li className="capitalize font-semibold text-md"><Link to={'/activities'}>activities</Link></li>
                    <li className="capitalize font-semibold text-md"><Link to={'/rewards'}>rewards</Link></li>
                </ul>
            </div>
        </div>
    )
}
