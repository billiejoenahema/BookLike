import React, { useEffect, useState, useRef } from 'react'
import ReactDOM from 'react-dom'
import { useDebounce } from 'use-debounce'
import InputField from './InputField'
import Users from './Users'
import Loading from '../Loading'

const UserIndex = () => {

  const [loginUser, setLoginUser] = useState()
  const [allUsers, setAllUsers] = useState([])
  const [sort, setSort] = useState('default')
  const [page, setPage] = useState(1)
  const [hasMore, setHasMore] = useState(false)
  const [loading, setLoading] = useState(false)
  const [value, setValue] = useState('')
  const [searchWord] = useDebounce(value, 500)
  const [maxTextLength, setTextLength] = useState(100)

  useEffect(() => {
    const loadUsers = async () => {
      setLoading(true)
      const newUsers = await axios
        .get(`/api/users?sort=${sort}&page=${page}`)
        .then(res => {
          setLoginUser(res.data.loginUser)
          page < res.data.users.last_page && setHasMore(true)
          return res.data.users.data || res.data.users
        })
        .catch(err => {
          console.log(err)
        })
      setAllUsers(prev => [...prev, ...newUsers])
      setLoading(false)
    }

    // スマホのときは表示する文字数を減らす
    if (window.matchMedia('(max-device-width: 640px)').matches) {
      setTextLength(30)
    }

    loadUsers()
  }, [page, sort])

  const userList = allUsers.filter((item) => {
    // nameとscreen_nameのどちらかが部分一致するユーザーを探す
    if (item.name) {
      return item.name.toLowerCase().indexOf(searchWord.toLowerCase()) > -1 || item.screen_name.toLowerCase().indexOf(searchWord.toLowerCase()) > -1
    }
    // nameがNULLの場合はscreen_nameのみで処理
    return item.screen_name.toLowerCase().indexOf(searchWord.toLowerCase()) > -1
  })

  const handleSearch = (e) => {
    setValue(e.target.value)
  }

  const sortChange = (e) => {
    const selectedSort = document.getElementById('selectSort').value
    setSort(selectedSort)
    setAllUsers([])
    setPage(1)
    setHasMore(false)
    setSearchWord('')
  }

  const body = document.getElementById('body')
  body.onscroll = () => {
    const scrollAmount = window.scrollY
    const clientHeight = document.getElementById('usersComponent').clientHeight

    if (hasMore && clientHeight - scrollAmount < 1000) {
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
  }, [userList])

  return (
    <>
      <InputField value={value} handleSearch={handleSearch} />
      <div className="form-group d-flex justify-content-end pt-2 sort-changer">
        <div className="d-flex flex-row col-8 p-0">
          <label htmlFor="selectSort" className="w-100 text-right py-1 mr-1 mb-0">並び替え</label>
          <select onChange={sortChange} className="form-control-sm" id="selectSort">
            <option value="default">登録順</option>
            <option value="review">投稿数</option>
            <option value="follower">フォロワー数</option>
            <option value="favorite">いいね獲得数</option>
          </select>
        </div>
      </div>
      <div id="usersComponent">
        <Users users={userList} loginUser={loginUser} maxTextLength={maxTextLength} />
      </div>

      {/* Loading Spinner */}
      <div className="text-center">
        {loading && < Loading />}
        {!loading && (userList.length === 0) && 'ユーザーは見つかりませんでした'}

      </div>

    </>
  )
}

export default UserIndex

if (document.getElementById('userIndex')) {
  ReactDOM.render(<UserIndex />, document.getElementById('userIndex'))
}
