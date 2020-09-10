import React, { useState, useEffect, useCallback } from "react"
import ReactTooltip from 'react-tooltip'

const FavoriteButton = (props) => {

    // const [isFavo, setFavo] = useState(false);
    // const toggleFavo = useCallback(() => setFavo((prev) => !prev), [setFavo])

    function isFavorite(popular, loginUser) {
        const favoritesArray = Array.from(popular.favorites)
        const userIds = favoritesArray.map(v => v.user_id)
        return userIds.includes(loginUser.id)
    }

    return (
        <button className="btn p-0 border-0">
            {
                isFavorite(props.popular, props.loginUser) ? <i className="fas fa-heart fa-fw text-danger"></i>
                    : <i className="far fa-heart fa-fw text-primary"></i>
            }
        </button>
    )
}

export default FavoriteButton
