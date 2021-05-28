import React from 'react'

const UserName = ({ userName, screenName }) => {
  return (
    <div className="ml-2 d-flex flex-column">
      <p className="mb-0">{userName || screenName}</p>
      <span className="text-secondary">{screenName}</span>
    </div>
  )
}

export default UserName
