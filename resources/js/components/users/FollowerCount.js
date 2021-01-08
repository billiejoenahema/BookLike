import React from 'react'

const FollowerCount = (props) => {

    const followerCount = props.user.followers_count
    // const followerCount = props.user.followers.length

    return (
        <>
            フォロワー<span className="badge-teal badge-pill text-white ml-1 user-select-none">{followerCount}</span>
        </>
    )
}
export default FollowerCount
