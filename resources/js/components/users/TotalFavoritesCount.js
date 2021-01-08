import React from 'react'

const TotalFavoritesCount = (props) => {

    const totalFavoritesCount = props.user.favorites_count

    return (
        <>
            <span>いいね獲得数</span><span className="badge-pink badge-pill text-white ml-1 user-select-none">{totalFavoritesCount}</span>
        </>
    )
}
export default TotalFavoritesCount

