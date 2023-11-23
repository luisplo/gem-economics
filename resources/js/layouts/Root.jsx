import Navbar from "./Navbar"
import { Outlet } from "react-router-dom";

export default function Root() {
    return (
        <div>
            <Navbar />
            <div className="container mx-auto py-8">
                <Outlet />
            </div>
        </div>
    )
}
