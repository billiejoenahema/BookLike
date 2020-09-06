import React from "react";
import ReactDom from "react-dom";

class FavoriteButton extends React.Component {
    render() {
        return (
            <span>いいねボタン予定地</span>
        );
    }
}

export default FavoriteButton

// いいねがついた状態
function FavoriteButton(props) {
    return (
        <button onClick={props.onClick}>
            <i class="fas fa-heart fa-fw"></i>
        </button>
    );
}

// いいねがついていない状態
function NotFavoriteButton(props) {
    return (
        <button onClick={props.onClick}>
            <i class="far fa-heart fa-fw"></i>
        </button>
    );
}

// 表示の切り替え
function Likeing(props) {
    const isFavorite = props.isFavorite;
    if (isFavorite) {
        return <Favorite />;
    }
    return <NotFavorite />;
}
