import React from 'react'

const TotalFavoritesCount = (props) => {

    const totalFavoritesCount = props.favorites_count

    return (
        <>
            いいね獲得数<span className="badge-pink badge-pill text-white ml-1 user-select-none">{totalFavoritesCount}</span>
        </>
    )
}
export default TotalFavoritesCount

