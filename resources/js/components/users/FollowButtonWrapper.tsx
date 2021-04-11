import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import FollowButton from './FollowButton'

const FollowButtonWrapper = () => {

    const [user, setUser] = useState('')
    const [loginUser, setLoginUser] = useState('')
    const currentPath = window.location.pathname

    useEffect(() => {
        loadIsFollowed()
    }, [])

    const loadIsFollowed = async () => {
        await axios
            .get(`/api${currentPath}`)
            .then(res => {
                setUser(res.data.profileUser)
                setLoginUser(res.data.loginUser)
            })
            .catch(err => {
                console.log(err)
            })
    }


    return (
        <>
            {user && loginUser && < FollowButton user={user} loginUser={loginUser} />}
        </>
    )
}

export default FollowButtonWrapper
if (document.getElementById('followButtonWrapper')) {
    ReactDOM.render(<FollowButtonWrapper />, document.getElementById('followButtonWrapper'))
}
