import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Users from './Users'

const UserIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [allUsers, setAllUsers] = useState([])
    const [page, setPage] = useState(1)
    const [hasMore, setHasMore] = useState(false)
    const [loading, setLoading] = useState(false)
    const [searchWord, setSearchWord] = useState('')
    const body = document.getElementById('body')

    useEffect(() => {
        const loadUsers = async () => {
            setLoading(true)
            const newUsers = await axios
                .get(`/api/users?page=${page}`)
                .then(res => {
                    console.log(res)
                    setLoginUser(res.data.loginUser)
                    if (page < res.data.users.last_page) {
                        setHasMore(true)
                    }
                    return res.data.users
                })
                .catch(err => {
                    console.log(err)
                })
            setAllUsers(prev => [...prev, ...newUsers.data])
            setLoading(false)
        }
        loadUsers()
    }, [page])

    const userList = allUsers.filter((item) => {
        return item.name.indexOf(searchWord) > -1
    })

    const handleSearch = (e) => {
        setSearchWord(e.target.value)
    }

    body.onscroll = () => {
        const scrollTop = window.scrollY
        const clientHeight = document.getElementById('usersComponent').clientHeight
        console.log(clientHeight - scrollTop)
        if (hasMore && clientHeight - scrollTop < 550) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }

    return (
        <>
            <input
                className="form-control col-4 search-form pl-1 pr-0"
                type="search"
                value={searchWord}
                onChange={handleSearch}
                placeholder="ユーザー検索..."
                aria-label="ユーザー検索"
                required autoComplete="on"
            />
            <div id="usersComponent">
                <Users users={userList} loginUser={loginUser} />
            </div>
            <div className="text-center">
                {loading && '読み込み中...'}
            </div>
        </>
    )
}

export default UserIndex

if (document.getElementById('userIndex')) {
    ReactDOM.render(<UserIndex />, document.getElementById('userIndex'))
}
