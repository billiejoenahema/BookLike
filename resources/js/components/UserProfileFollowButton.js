import React, { useState, useEffect, useCallback } from 'react'
import ReactDOM from 'react-dom'
import isFollowed from '../functions/isFollowed'

const UserProfileFollowButton = () => {

    const [user, setUser] = useState()
    const [following, setFollowing] = useState()
    const toggleFollow = useCallback(() => setFollowing((prev) => !prev), [setFollowing])
    const url = window.location.pathname

    useEffect(() => {
        const loadIsFollowed = async () => {
            await axios
                .get(`/api${url}`)
                .then(res => {
                    console.log(res)
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
        console.log('FollowButton Clicked!')
        toggleFollow()

        return axios.post(`http://127.0.0.1:8000/api/users/${user.id}/follow`)
            .then(res => {
                console.log('Success!')
                console.log(user.id)
            })
            .catch(err => {
                console.log('Failure!')
            })
    }

    const DeleteFollow = () => {
        console.log('UnFollowButton Clicked!')
        toggleFollow()

        return axios.post(`http://127.0.0.1:8000/api/users/${user.id}/unfollow`)
            .then(res => {
                console.log('Success!')
                console.log(user.id)
            })
            .catch(err => {
                console.log('Failure!')
                console.log(err)
                console.log(user.id)

            })
    }

    return (
        <>
            {
                following ?
                    <div onClick={DeleteFollow} className="btn-sm btn-blog rounded-pill shadow-sm border-0">フォロー中</div>
                    : <div onClick={PostFollow} className="btn-sm btn-outline-blog rounded-pill shadow-sm border-0">フォローする</div>
            }
        </>
    )
}

export default UserProfileFollowButton
if (document.getElementById('userProfileFollowButton')) {
    ReactDOM.render(<UserProfileFollowButton />, document.getElementById('userProfileFollowButton'))
}
