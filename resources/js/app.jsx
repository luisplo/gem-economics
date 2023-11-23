
import './bootstrap';
import '../css/app.css';
import 'react-toastify/dist/ReactToastify.min.css';

import ReactDOM from 'react-dom/client';
import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";
import Dashboard from './components/Dashboard';
import ErrorPage from './layouts/ErrorPage';
import Root from './layouts/Root';
import ActivityList from './components/ActivityList';
import { GlobalProvider } from './context/GlobalContext';
import { ToastContainer } from "react-toastify";
import RewardsList from './components/RewardsList';

const router = createBrowserRouter([
    {
        path: "/",
        element: <Root />,
        errorElement: <ErrorPage />,
        children: [
            {
                path: "/",
                element: <Dashboard />,
            },
            {
                path: "/activities",
                element: <ActivityList />,
            },
            {
                path: "/rewards",
                element: <RewardsList />,
            },
        ],
    },

]);

ReactDOM.createRoot(document.getElementById("root")).render(
    <GlobalProvider>
        <ToastContainer
            position="top-right"
            autoClose={1500}
            hideProgressBar={false}
            newestOnTop={true}
            closeOnClick
            rtl={false}
            pauseOnFocusLoss
            draggable
            pauseOnHover
            theme="light"
            limit={5}
        />
        <RouterProvider
            router={router}
            fallbackElement={
                <div className='flex h-screen'>
                    <div className='m-auto'>
                        <span class="loading loading-spinner loading-lg"></span>
                    </div>
                </div>
            }
        />
    </GlobalProvider>
);

