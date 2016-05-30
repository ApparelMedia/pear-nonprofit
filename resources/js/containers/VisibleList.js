import React, { PropTypes, Component } from 'react'
import { connect } from 'react-redux'
import NonprofitList from '../components/NonprofitList'

const mapStateToProps = (state) => {
    return {
        nonprofits: state.nonprofits
    }
}

const VisibleList = connect(mapStateToProps)(NonprofitList)

export default VisibleList
