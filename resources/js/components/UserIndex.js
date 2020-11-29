import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Users from './Users'
import Loading from './Loading'

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
                    setLoginUser(res.data.loginUser)
                    page < res.data.users.last_page && setHasMore(true)
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
        // nameとscreen_nameのどちらかが部分一致するユーザーを探す
        return item.name.toLowerCase().indexOf(searchWord) > -1 || item.screen_name.toLowerCase().indexOf(searchWord) > -1
    })

    const handleSearch = (e) => {
        setSearchWord(e.target.value)
    }

    const sortChange = (e) => {
        e.target.value === 'follower' ? setSelectedPopular(true) : setSelectedPopular(false)
        setAllUsers([])
        setPage(1)
        setHasMore(false)
        setSearchWord('')
    }

    const body = document.getElementById('body')
    body.onscroll = () => {
        const scrollAmount = window.scrollY
        const clientHeight = document.getElementById('usersComponent').clientHeight

        if (hasMore && clientHeight - scrollAmount < 700) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }

    useEffect(() => {
        if (userList < 10 && hasMore) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }, [userList])

    return (
        <>
            <input
                className="form-control col-5 col-sm-4 col-md-3 col-lg-2 user-search-form rounded-pill pr-0"
                type="search"
                value={searchWord}
                onChange={handleSearch}
                placeholder="ユーザー検索..."
                aria-label="ユーザー検索"
                required autoComplete="on"
            />
            <div className="form-group d-flex justify-content-end">
                <div className="d-flex flex-row col-8 p-0">
                    <label htmlFor="selectSort" className="w-100 text-right py-1 mr-1">並び替え</label>
                    <select onChange={sortChange} className="form-control-sm" id="selectSort">
                        <option value="default">登録順</option>
                        <option value="follower">フォロワー数</option>
                    </select>
                </div>
            </div>
            <div id="usersComponent">
                <Users users={userList} loginUser={loginUser} />
            </div>

            {/* Loading Spinner */}
            <div className="text-center">
                {loading && < Loading />}
            </div>

        </>
    )
}

export default UserIndex

if (document.getElementById('userIndex')) {
    ReactDOM.render(<UserIndex />, document.getElementById('userIndex'))
}
