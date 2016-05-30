import React, {Component} from 'react';
import NonprofitItem from './NonprofitItem'

class NonprofitList extends Component {
    render () {
        return (
           <ul>
               {this.props.nonprofits.map(function(org) {
                   return <NonprofitItem key={org.id}
                       {...org}
                   />
               })}
           </ul>
        )
    }
}

export default NonprofitList
