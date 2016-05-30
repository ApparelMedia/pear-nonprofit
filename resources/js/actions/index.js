export const searchDone = (data) => {
    return {
        type: 'SEARCH_DONE',
        data
    }
}

export const newSearch = (query) => {
    return {
        type: 'NEW_SEARCH',
        query
    }
}

export const newQuery = (query) => {
    return {
        type: 'NEW_QUERY',
        query
    }
}
