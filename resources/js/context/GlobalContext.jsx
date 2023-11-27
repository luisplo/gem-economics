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
        case 'activities': {
            return { ...state, activities: action.activities, initial_activities: false }
        } case 'rewards': {
            return { ...state, rewards: action.rewards, initial_rewards: false }
        } case 'intervals': {
            return { ...state, intervals: action.intervals, initial_intervals: false }
        } case 'modal': {
            return { ...state, modal: action.modal }
        } case 'create-economy': {
            return {
                ...state, [action.module]: [
                    ...state[action.module],
                    {
                        id: action[action.module].id,
                        name: action[action.module].name,
                        description: action[action.module].description,
                        value: action[action.module].value,
                        frequency: action[action.module].frequency,
                        disabled: action[action.module].disabled,
                        intervals: {
                            id: action[action.module].intervals_id,
                        }
                    }
                ]
            }
        } case `update-list-disabled`: {
            return {
                ...state, [action.module]: state[action.module].map((item) => {
                    if (item.id == action[action.module].id) {
                        item.disabled = action[action.module].disabled
                    }
                    return item
                })
            }
        } case `update-list-delete`: {
            return {
                ...state, [action.module]: state[action.module].filter(item => item.id !== action[action.module].id)
            }
        } default: {
            throw Error('Unknown action: ' + action.type);
        }
    }
}

const initialState = {
    initial_activities: true,
    initial_rewards: true,
    initial_intervals: true,
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
        url: '',
        action: '',
        title: null,
        method: '',
        module: '',
    },
    activities: [],
    rewards: [],
}
