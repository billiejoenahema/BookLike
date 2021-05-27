import React from 'react'
import { STORAGE } from '../../constants'

const UserIcon = ({ reviewId, reviewUser, hoverUserIcon, leaveUserIcon }) => {

  return (
    <a href={`/users/${reviewUser.id}`} className="text-reset">
      <img src={`${STORAGE}/${reviewUser.profile_image}`}
        className="rounded-circle shadow-sm"
        width="48" height="48"
        data-id={reviewId}
        onMouseEnter={hoverUserIcon}
        onMouseLeave={leaveUserIcon}
      />
    </a>
  )
}

export default UserIcon
