import React from 'react'

const TotalFavoritesCount = ({ favoritesCount }) => {


  return (
    <>
      <span>いいね獲得数</span>
      <span className="badge-pink badge-pill text-white ml-1 user-select-none">{favoritesCount}</span>
    </>
  )
}
export default TotalFavoritesCount

