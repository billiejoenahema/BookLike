import React, { useState, useCallback } from 'react'
import isFollowed from '../functions/isFollowed'

const FollowButton = (props) => {

    const InitialFollowState = isFollowed(props.user, props.loginUser)
    const userId = props.user.id
    const [following, setFollowing] = useState(InitialFollowState)

    const toggleFollow = useCallback(
        () => setFollowing((prev) => !prev), [setFollowing]
    )

    const PostFollow = (e) => {
        toggleFollow()

        return axios.post(`/api/follow/${userId}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
            })
    }

    const DeleteFollow = (e) => {
        toggleFollow()

        return axios.post(`/api/unfollow/${userId}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)

            })
    }

    return (
        <>
            {
                following ?
                    <div onClick={DeleteFollow} className="btn-sm btn-blog rounded-pill shadow-sm border-0 follow-btn">フォロー中</div>
                    : <div onClick={PostFollow} className="btn-sm btn-outline-blog rounded-pill shadow-sm border-0 follow-btn">フォローする</div>
            }
        </>
    )
}

export default FollowButton
