import { combineReducers } from 'redux'
import nonprofits from './nonprofits'
import query from './query'

const appReducer = combineReducers({
    query,
    nonprofits
})

export default appReducer;
