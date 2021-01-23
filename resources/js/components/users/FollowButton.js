import React, { useState, useCallback } from 'react'
import isFollowed from '../../functions/isFollowed'

const FollowButton = (props) => {

    const InitialFollowState = isFollowed(props.user, props.loginUser)

    const userId = props.user.id
    const [following, setFollowing] = useState(InitialFollowState)

    const toggleFollow = useCallback(
        () => setFollowing((prev) => !prev), [setFollowing]
    )

    const requestFollow = useCallback((request) => {
        return axios.post(`/api/${request}/${userId}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
            })
    })

    const addFollow = () => {
        toggleFollow()
        requestFollow('follow')
    }
    const removeFollow = () => {
        toggleFollow()
        requestFollow('unfollow')
    }

    return (
        <>
            {
                following ?
                    <div onClick={removeFollow} className="btn-sm btn-blog rounded-pill shadow-sm border-0 follow-btn">フォロー中</div>
                    : <div onClick={addFollow} className="btn-sm btn-outline-blog rounded-pill shadow-sm border-0 follow-btn">フォローする</div>
            }
        </>
    )
}

export default FollowButton
