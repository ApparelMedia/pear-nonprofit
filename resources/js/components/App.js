import React, {Component} from 'react';
import SearchNonprofit from '../containers/SearchNonprofit'
import VisibleList from '../containers/VisibleList'

class App extends Component {
    render () {
        return (
            <div>
                <SearchNonprofit />
                <VisibleList />
            </div>
        )
    }
}

export default App
