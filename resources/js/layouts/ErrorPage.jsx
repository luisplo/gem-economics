import { useRouteError, Link } from "react-router-dom";
import KeyboardReturnIcon from '@mui/icons-material/KeyboardReturn';

export default function ErrorPage() {
    const error = useRouteError();

    return (
        <div id="error-page" className="flex h-screen">
            <div className="m-auto">
                <h1 className="text-center text-8xl mb-10 font-bold capitalize">Oops!</h1>
                <p className="text-center text-xl normal-case">Sorry, an unexpected error occurred</p>
                <p className="text-center text-sm normal-case">{`${error.error.message} - ${error.status}`}</p>
                <div className="text-center py-6">
                    <Link className="text-xl font-semibold" to={'/'}>
                        Go home
                        <KeyboardReturnIcon className="ml-3" />
                    </Link>
                </div>
            </div>
        </div>
    );
}
