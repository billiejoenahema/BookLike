import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Users from './Users'

const UserIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [allUsers, setAllUsers] = useState([])
    const [selectedPopular, setSelectedPopular] = useState(false)
    const [page, setPage] = useState(1)
    const [hasMore, setHasMore] = useState(false)
    const [loading, setLoading] = useState(false)
    const [searchWord, setSearchWord] = useState('')

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
                    if (selectedPopular) {
                        return res.data.populars.data
                    }
                    return res.data.users.data
                })
                .catch(err => {
                    console.log(err)
                })
            setAllUsers(prev => [...prev, ...newUsers])
            setLoading(false)
        }
        loadUsers()
    }, [page, selectedPopular])

    const userList = allUsers.filter((item) => {
        return item.name.indexOf(searchWord) > -1
    })

    const handleSearch = (e) => {
        setSearchWord(e.target.value)
    }

    const handleChange = (e) => {
        if (e.target.value === 'follower') {
            setSelectedPopular(true)
            setAllUsers([])
            setPage(1)
            setHasMore(false)
        } else {
            setSelectedPopular(false)
        }
    }

    const body = document.getElementById('body')
    body.onscroll = () => {
        const scrollTop = window.scrollY
        const clientHeight = document.getElementById('usersComponent').clientHeight
        if (hasMore && clientHeight - scrollTop < 700) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }

    return (
        <>
            <input
                className="form-control col-4 search-form rounded-pill pr-0"
                type="search"
                value={searchWord}
                onChange={handleSearch}
                placeholder="ユーザー検索..."
                aria-label="ユーザー検索"
                required autoComplete="on"
            />
            <div className="form-group d-flex justify-content-end">
                <div className="d-flex flex-row col-8">
                    <label htmlFor="selectSort" className="w-100 text-right py-1 mr-1">並び替え</label>
                    <select onChange={handleChange} className="form-control-sm" id="selectSort">
                        <option value="default">登録順</option>
                        <option value="follower">フォロワー数</option>
                    </select>
                </div>
            </div>
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
