import React from 'react'

const FollowerCount = (props) => {

    const followerCount = props.user.followers_count

    return (
        <>
            フォロワー<span className="badge-teal badge-pill text-white ml-1 user-select-none">{followerCount}</span>
        </>
    )
}
export default FollowerCount
