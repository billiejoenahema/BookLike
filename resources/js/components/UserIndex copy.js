import React, { useState, useRef, useCallback } from 'react'
import ReactDOM from 'react-dom'
import useInfiniteScroll from './useInfiniteScroll'
import FollowButton from './FollowButton'
import isFollowed from '../functions/isFollowed'
import omittedText from '../functions/omittedText'

const UserIndex = () => {


    const [query, setQuery] = useState("")
    const [pageNumber, setPageNumber] = useState(1)

    const observer = useRef()
    const lastUserElementRef = useCallback(node => {
        if (loading) return
        if (observer.current) observer.current.disconnect()
        observer.current = new IntersectionObserver(entries => {
            if (entries[0].isInsersecting && hasMore) {
                setPageNumber(prevPageNumber => prevPageNumber + 1)
            }
        })
        if (node) observer.current.observe(node)
    }, [loading, hasMore])

    const handleSearch = e => {
        setQuery(e.target.value)
        setPageNumber(1)
    }

    const {
        loginUser,
        users,
        hasMore,
        loading,
        error
    } = useInfiniteScroll(query, pageNumber)

    return (
        <>
            <div className="mb-3">
                <input
                    className="form-control col-10 col-md-6 shadow-sm"
                    onChange={handleSearch}
                    type="search"
                    value={query}
                    placeholder="ユーザー検索..."
                    aria-label="ユーザー検索"
                    required autoComplete="on"
                />
            </div>

            {users.map((user) => {
                <div className="card mb-3 shadow-sm" ref={lastUserElementRef} key={user.id}>
                    <div className="card-haeder p-3 w-100 d-flex flex-column">
                        {
                            isFollowed(loginUser, user) ?
                                <div className="mb-1 ml-5"><span className="text-secondary"><i className="far fa-laugh"></i>フォローされています</span></div>
                                : ''
                        }
                        <div className="d-flex w-100">
                            <a href={`http://127.0.0.1:8000/users/${user.id}`}>
                                <img src={`/storage/profile_image/${user.profile_image}`} className="rounded-circle shadow-sm" width="48" height="48" />
                            </a>
                            <div className="d-flex flex-wrap w-100">
                                <div className="ml-2 d-flex flex-column">
                                    <p className="mb-0">{user.name}</p>
                                    <span className="text-secondary small">{user.screen_name}</span>
                                </div>
                                {/* フォローボタン */}
                                {
                                    user.id !== loginUser.id ? <div className="ml-auto"><FollowButton user={user} loginUser={loginUser} /></div> : ''
                                }
                            </div>
                        </div>
                    </div>
                    <div className="card-body d-flex">
                        {/* 自己紹介文 */}
                        {/* <p>{omittedText(user.description, 100)}</p> */}
                        <p>{user.description}</p>
                    </div>
                </div>
            }
            )}
            <div>{loading && 'Loading...'}</div>
            <div>{error && 'Error'}</div>
        </>
    )
}

export default UserIndex

if (document.getElementById('userIndex')) {
    ReactDOM.render(<UserIndex />, document.getElementById('userIndex'))
}
