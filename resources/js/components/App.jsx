import React, {Component} from 'react';
import FileUpload from './components/FileUpload.jsx'
import SearchNonprofit from './components/SearchNonprofit.jsx'

class App extends Component {
    render () {
        return (
            <div>
                <FileUpload />
                <SearchNonprofit />
                <p>Hello React!</p>
            </div>
        )
    }
}

export default App