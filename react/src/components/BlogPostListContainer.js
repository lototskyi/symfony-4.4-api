import React from "react";
import BlogPostList from "./BlogPostList";
import {blogPostAdd, blogPostListFetch} from "../actions/actions";
import {connect} from "react-redux";

const mapStateToProps = state => ({
    ...state.blogPostList
});

const mapDispatchToProps = ({
    blogPostAdd,
    blogPostListFetch
});

class BlogPostListContainer extends React.Component {

    componentDidMount() {
        this.props.blogPostListFetch();
    }

    render() {
        return (<BlogPostList posts={this.props.posts} />);
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(BlogPostListContainer);