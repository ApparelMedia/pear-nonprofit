import React, { PropTypes, Component } from 'react'

class SearchBox extends Component {
    constructor({submitEvent, onInputChange}) {
        super()
        this.submitEvent = submitEvent
        this.onInputChange = onInputChange
    }

    render() {
        return (
            <div>
            <form onSubmit={(e) => {
                    e.preventDefault()
                    this.submitEvent(this.inputBox.value.trim())
                }}>
                <input type="text" ref={(node) => {
                    this.inputBox = node
                }} value={
                    this.props.query
                } onChange={(e) => {
                    this.onInputChange(e.target.value, this.inputBox)
                }} />
                <button type="submit">Search</button>
            </form>
            </div>
        )
    }
}

SearchBox.PropTypes = {
    onSubmit: PropTypes.func.isRequired
}

export default SearchBox
