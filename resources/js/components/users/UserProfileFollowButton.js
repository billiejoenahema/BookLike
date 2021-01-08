import React, { useState, useEffect, useCallback } from 'react'
import ReactDOM from 'react-dom'
import isFollowed from '../../functions/isFollowed'

const UserProfileFollowButton = () => {

    const [user, setUser] = useState()
    const [following, setFollowing] = useState()
    const toggleFollow = useCallback(() => setFollowing((prev) => !prev), [setFollowing])
    const currentPath = window.location.pathname

    useEffect(() => {
        const loadIsFollowed = async () => {
            await axios
                .get(`/api${currentPath}`)
                .then(res => {
                    setUser(res.data.profileUser)
                    const initialState = isFollowed(res.data.profileUser, res.data.loginUser)
                    setFollowing(initialState)
                })
                .catch(err => {
                    console.log(err)
                })
        }
        loadIsFollowed()
    }, [])

    const PostFollow = () => {
        toggleFollow()

        return axios.post(`/api/follow/${user.id}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
            })
    }

    const DeleteFollow = () => {
        toggleFollow()

        return axios.post(`/api/unfollow/${user.id}`)
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

export default UserProfileFollowButton
if (document.getElementById('userProfileFollowButton')) {
    ReactDOM.render(<UserProfileFollowButton />, document.getElementById('userProfileFollowButton'))
}
