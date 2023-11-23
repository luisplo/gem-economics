import { createContext, useReducer, useContext } from "react";

const GlobalContext = createContext(null)
const GlobalDispatchContext = createContext(null)

export function GlobalProvider({ children }) {
    const [global, dispatch] = useReducer(
        globalReducer,
        initialState
    )

    return (
        <GlobalContext.Provider value={global}>
            <GlobalDispatchContext.Provider value={dispatch}>
                {children}
            </GlobalDispatchContext.Provider>
        </GlobalContext.Provider>
    )
}

export function useGlobal() {
    return useContext(GlobalContext)
}

export function useGlobalDispatch() {
    return useContext(GlobalDispatchContext)
}

function globalReducer(state, action) {
    switch (action.type) {
        case 'refresh': {
            return { ...state, refresh: state.refresh != action.refresh }
        } case 'loading': {
            return { ...state, loading: action.loading }
        } case 'modal': {
            return { ...state, modal: { ...state.modal, title: action.title } }
        } case 'modal-confirm': {
            return { ...state, modal: { ...state.modal, confirm: state.model.confirm != state.model.confirm } }
        } default: {
            throw Error('Unknown action: ' + action.type);
        }
    }
}


const initialState = {
    refresh: false,
    loading: false,
    edit: {
        name: '',
        description: '',
        value: 0,
        intervals_id: null,
        frequency: 0,
    },
    modal: {
        title: 'Modal',
        button: 'Confirmar',
        confirm: false,
    }
}
