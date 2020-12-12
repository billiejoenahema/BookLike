import React from 'react'

const TotalFavoritesCount = (props) => {

    const user = props.user
    const totalFavoritesCount = user.reviews.reduce((a, b) => a + b.favorites.length, 0)

    return (
        <>
            <span>いいね獲得数</span><span className="badge-purple badge-pill text-white ml-1">{totalFavoritesCount}</span>
        </>
    )
}
export default TotalFavoritesCount

