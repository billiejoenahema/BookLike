import React from 'react'

const FollowerCount = ({ user }) => {

  const followerCount = user.followers_count

  return (
    <>
      <span>フォロワー</span>
      <span className="badge-teal badge-pill text-white ml-1 user-select-none">{followerCount}</span>
    </>
  )
}
export default FollowerCount
