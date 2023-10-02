import {
    BLOG_POST_FORM_UNLOAD, IMAGE_DELETE_REQUEST,
    IMAGE_DELETED,
    IMAGE_UPLOAD_ERROR,
    IMAGE_UPLOAD_REQUEST,
    IMAGE_UPLOADED
} from "../actions/constants";

export default (state = {
    imageRequestInЗrogress: false,
    images: []
}, action) => {
    switch(action.type) {
        case IMAGE_UPLOAD_REQUEST:
        case IMAGE_DELETE_REQUEST:
            return {
                ...state,
                imageRequestInProgress: true
            };
        case IMAGE_UPLOADED:
            return {
                ...state,
                imageRequestInProgress: false,
                images: state.images.concat(action.image)
            };
        case IMAGE_UPLOAD_ERROR:
            return {
                ...state,
                imageRequestInProgress: false
            };
        case BLOG_POST_FORM_UNLOAD:
            return {
                ...state,
                imageRequestInProgress: false,
                images: []
            };
        case IMAGE_DELETED:
            return {
                ...state,
                images: state.images.filter(image => image.id !== action.imageId),
                imageRequestInProgress: false
            }
        default:
            return state;
    }
};