import React, { Component } from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import { createStore } from 'redux'
import appReducer from './reducers'

import App from './components/App.js';

let initialState = {
    query: '',
    nonprofits: []
}

let store = createStore(appReducer, initialState, window.devToolsExtension && window.devToolsExtension())

console.log(store.getState());

render(
    <Provider store={store}>
        <App />
    </Provider>
    , document.getElementById('app'));
