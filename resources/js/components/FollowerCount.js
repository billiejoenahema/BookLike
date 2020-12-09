import React from 'react'

const FollowerCount = (props) => {
    return (
        <div className="mt-2">
            フォロワー<span className="badge badge-blog badge-pill text-white align-middle ml-1">{props.followerCount}</span>
        </div>
    )
}
export default FollowerCount
