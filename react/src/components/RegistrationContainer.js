import React from "react";
import RegisterForm from "./RegisterForm";
import {connect} from "react-redux";
import ConfirmationForm from "./ConfirmationForm";
import {userRegisterComplete} from "../actions/actions";

const mapStateToprops = state => ({
    ...state.registration
});

const mapDispatchToProps = {
    userRegisterComplete
};

class RegistrationContainer extends React.Component {

    constructor(props) {
        super(props);
        this.state = {counter: 10};
    }

    componentWillUnmount() {
        this.props.userRegisterComplete();
        if (this.timer) {
            clearInterval(this.timer);
        }
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        const {confirmationSuccess, history, userRegisterComplete} = this.props;

        if (prevProps.confirmationSuccess !== confirmationSuccess && confirmationSuccess) {
            this.timer = setInterval(
                () => {
                    this.setState(prevState => ({counter: prevState.counter - 1}))
                },
                1000
            );
        }

        if (prevState.counter !== this.state.counter && this.state.counter <= 0) {
            this.props.userRegisterComplete();
            history.push('/');
        }
    }

    render() {
        const {registrationSuccess, confirmationSuccess} = this.props;

        if (!registrationSuccess) {
            return <RegisterForm />;
        }

        if (!confirmationSuccess) {
            return <ConfirmationForm />
        }

        return (
            <div className="card mb-3 mt-3 shadow-sm">
                <div className="card-body">
                    <h2>Congratulations!</h2>
                    <p className="card-text">
                        You have confirmed your account. You'll be redirected to home page in&nbsp;
                        {this.state.counter} seconds.
                    </p>
                </div>
            </div>
        );
    }
}

export default connect(mapStateToprops, mapDispatchToProps)(RegistrationContainer);