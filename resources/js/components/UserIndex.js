import React, { useEffect, useState } from 'react'

import ReactDOM from 'react-dom'
import Users from './Users'


const UserIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [allUsers, setAllUsers] = useState([])

    useEffect(() => {
        axios
            .get('/api/users')
            .then(res => {
                console.log(res)
                setLoginUser(res.data.loginUser)
                setAllUsers(res.data.allUsers)
            })
            .catch(err => {
                console.log(err)
            })
    }, [])

    return (
        <>
            <Users users={allUsers} loginUser={loginUser} />
        </>
    )
}

export default UserIndex

if (document.getElementById('userIndex')) {
    ReactDOM.render(<UserIndex />, document.getElementById('userIndex'))
}
