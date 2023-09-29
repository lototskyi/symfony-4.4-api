import React from "react";
import {Link} from "react-router-dom";

export default class Header  extends React.Component {

    renderUser() {
        const {userData, logout} = this.props;

        if (null === userData) {
            return (<i className="fas fa-spinner fa-spin"></i>);
        }

        return (
            <span>
                Hello {userData.name},&nbsp;
                <button className="btn btn-link btn-sm" onClick={logout}>Logout</button>
            </span>
        );
    }

    render() {
        const {isAuthenticated} = this.props;

        return (
            <nav className="navbar navbar-expand-lg navbar-right bg-light">
                <Link to="/" className="navbar-brand">
                    React Blog
                </Link>
                <ul className="navbar-nav mr-auto">
                    {
                        !isAuthenticated &&
                        (
                            <li className="nav-item">
                                <Link to="/register" >Register</Link>
                            </li>
                        )
                    }
                </ul>
                <span className="navbar-text">
                    {isAuthenticated ? this.renderUser() : <Link to="/login">Sign-in</Link>}
                </span>
            </nav>
        );
    }

}