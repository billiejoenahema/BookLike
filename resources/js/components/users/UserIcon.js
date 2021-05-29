import React from 'react'
import { STORAGE } from '../../constants'
import ReviewsCount from '../users/ReviewsCount'
import FollowerCount from '../users/FollowerCount'
import TotalFavoritesCount from '../users/TotalFavoritesCount'

const UserIcon = (
  {
    reviewUser,
    favoritesCount,
    reviewId,
    profileImage,
    hoverUserIcon,
    leaveUserIcon,
    iconSize
  }) => {
  return (
    <>
      {/* ツールチップ */}
      <div className={`user-counts shadow-sm d-none review-${reviewId}`} >
        <div className="count d-flex justify-content-between mb-1">
          <ReviewsCount user={reviewUser} />
        </div>
        <div className="count d-flex justify-content-between mb-1">
          <FollowerCount user={reviewUser} />
        </div>
        <div className="count d-flex justify-content-between">
          <TotalFavoritesCount user={reviewUser} favorites_count={favoritesCount} />
        </div>
      </div>
      {/* ユーザーアイコン */}
      <a href={`/users/${reviewUser.id}`} className="text-reset">
        <img src={`${STORAGE}/${profileImage}`}
          className="rounded-circle shadow-sm"
          width={iconSize} height={iconSize}
          data-id={reviewId}
          onMouseEnter={hoverUserIcon}
          onMouseLeave={leaveUserIcon}
        />
      </a>
    </>
  )
}

export default UserIcon
