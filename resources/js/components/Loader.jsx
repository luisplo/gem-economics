export default function Loader({ loading = false }) {

    return loading && (
        <div className="py-16 text-center">
            <span className="loading loading-spinner loading-lg"></span>
            <p className="mt-3 capitalize">loading</p>
        </div>
    )
}
