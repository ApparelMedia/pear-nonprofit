import React, {Component} from 'react';

class NonprofitItem extends Component {
    render () {
        let {ein, name, city, state} = this.props;
        return (
           <li>
               Ein: {ein}   <br />
               Name: {name} <br />
               City: {city} <br />
               State: {state}
           </li>
        )
    }
}

export default NonprofitItem
