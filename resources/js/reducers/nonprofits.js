const nonprofits = ( state = [], action ) => {
    switch (action.type) {
        case 'SEARCH_DONE':
            return action.data
        case 'NEW_SEARCH':
            return []
    }

    return state
}

export default nonprofits
