import React, { useState, useCallback } from 'react'
import isFollowed from '../functions/isFollowed'

const FollowButton = (props) => {

    const InitialFollowState = isFollowed(props.user, props.loginUser)
    const userId = props.user.id
    const user = props.user

    const [following, setFollowing] = useState(InitialFollowState)
    const toggleFollow = useCallback(() => setFollowing((prev) => !prev), [setFollowing])

    const PostFollow = () => {
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

    const DeleteFollow = () => {
        toggleFollow()
        console.log('UnFollowButton Clicked!')

        return axios.delete(`http://127.0.0.1:8000/api/users/${userId}/unfollow`)
            .then(res => {
                console.log('Success!')
                console.log(userId)
            })
            .catch(err => {
                console.log('Failure!')
                console.log(err)
                console.log(userId)

            })
    }

    return (
        <>
            {
                following ?
                    <button onClick={DeleteFollow} className="btn-sm btn-primary rounded-pill shadow-sm border-0">フォロー中</button>
                    : <button onClick={PostFollow} className="btn-sm btn-outline-primary rounded-pill shadow-sm border-0">フォローする</button>
            }
        </>
    )
}

export default FollowButton
