import React from 'react'

const UserInfo = ({ userName, screenName, created_at }) => {
  return (
    <>
      <div className="ml-2 d-flex flex-column">
        <p className="mb-0">{userName || screenName}</p>
        <span className="text-secondary">{screenName}</span>
      </div>
      <div className="d-flex justify-content-end flex-grow-1">
        <p className="mb-0 text-secondary">{formatDate(created_at, 'yyyy/MM/dd')}</p>
      </div>
    </>

  )
}

export default UserInfo
