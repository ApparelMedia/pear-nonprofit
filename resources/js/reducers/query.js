const query = ( state = '', action ) => {
    switch (action.type) {
        case 'NEW_SEARCH':
            return action.query
        case 'NEW_QUERY':
            return action.query
    }

    return state
}

export default query
