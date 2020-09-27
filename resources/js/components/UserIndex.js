import React, { useEffect, useState } from 'react'

import ReactDOM from 'react-dom'
import Users from './Users'

const UserIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [allUsers, setAllUsers] = useState([])
    const [searchWord, setSearchWord] = useState("")

    useEffect(() => {
        axios
            .get('/api/users', { data: searchWord })
            .then(res => {
                console.log(res)
                setLoginUser(res.data.loginUser)
                if (searchWord == null) {
                    setAllUsers(res.data.allUsers)
                } else {
                    const searchResults = res.data.allUsers.filter((item) => {
                        return item.name.indexOf(searchWord) > -1
                    })
                    setAllUsers(searchResults)
                }
            })
            .catch(err => {
                console.log(err)
            })
    }, [searchWord])

    const handleChange = e => {
        setSearchWord(e.target.value)
    }

    return (
        <>
            <div className="mb-3">
                <input
                    className="form-control col-10 col-md-6"
                    onChange={handleChange}
                    type="search"
                    value={searchWord}
                    placeholder="ユーザー検索..."
                    aria-label="ユーザー検索"
                    required autoComplete="on"
                />
            </div>
            <Users users={allUsers} loginUser={loginUser} />
        </>
    )
}

export default UserIndex

if (document.getElementById('userIndex')) {
    ReactDOM.render(<UserIndex />, document.getElementById('userIndex'))
}
