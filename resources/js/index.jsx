import React, { Component } from 'react'
import { render } from 'react-dom'
import { createStore } from 'redux'

import App from './components/App.jsx';



render(
    <Provider store={store}>
        <App />
    </Provider>
    , document.getElementById('app'));