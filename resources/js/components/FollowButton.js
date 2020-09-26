import React, { useState, useCallback } from 'react'
import isFollowed from '../functions/isFollowed'

const FollowButton = (props) => {

    const InitialFollowState = isFollowed(props.user, props.loginUser)
    const userId = props.user.id

    const [following, setFollowing] = useState(InitialFollowState)
    const toggleFollow = useCallback(() => setFollowing((prev) => !prev), [setFollowing])

    const follow = () => {
        toggleFollow()
        console.log('FollowButton Clicked!')

        return axios.post(`http://127.0.0.1:8000/api/users/${userId}/follow`)
            .then(res => {
                console.log('Success!')
                console.log(userId)
            })
            .catch(err => {
                console.log('Failure!')
            })
    }

    const unFollow = () => {
        toggleFollow()
        console.log('UnFollowButton Clicked!')

        return axios.delete(`http://127.0.0.1:8000/api/users/${userId}/unfollow`)
            .then(res => {
                console.log('Success!')
            })
            .catch(err => {
                console.log('Failure!')
            })
    }

    return (
        <>
            {
                following ?
                    <button onClick={unFollow} className="btn-sm btn-primary shadow-sm rounded-pill">フォロー中</button>
                    : <button onClick={follow} className="btn-sm btn-outline-primaryshadow-sm rounded-pill">フォローする</button>
            }
        </>
    )
}

export default FollowButton
