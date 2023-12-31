import React from "react";
import ReactDOM from "react-dom";
import {applyMiddleware, compose, createStore} from "redux";
import {createBrowserHistory} from "history";
import {ConnectedRouter} from "react-router-redux";
import {Route} from "react-router";
import {Provider} from "react-redux";
import App from "./components/App";
import reducer from "./reducer";
import thunkMiddleware from 'redux-thunk';
import {tokenMiddleware} from "./middleware";

const store = createStore(
    reducer,
    compose(
        applyMiddleware(thunkMiddleware, tokenMiddleware),
        window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
    )
);


const history = createBrowserHistory();

ReactDOM.render((
    <Provider store={store}>
        <ConnectedRouter history={history}>
            <Route path="/" component={App}/>
        </ConnectedRouter>
    </Provider>
), document.getElementById('root'));