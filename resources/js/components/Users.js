import React from 'react'
import FollowButton from './FollowButton'
import isFollowed from '../functions/isFollowed'
import omittedText from '../functions/omittedText'
import { STORAGE } from '../constants'

const Users = (props) => {

    const { users, loginUser } = props

    return (
        <>
            {users.map((user) =>
                <div className="card mb-3 shadow-sm" key={user.id}>
                    <div className="card-haeder p-3 w-100 d-flex flex-column">
                        {
                            isFollowed(loginUser, user) ?
                                <div className="mb-1 ml-5"><span className="text-secondary"><i className="far fa-laugh"></i>フォローされています</span></div>
                                : ''
                        }
                        <div className="d-flex w-100">
                            <a href={`/users/${user.id}`}>
                                <img src={`${STORAGE}/${user.profile_image}`} className="rounded-circle shadow-sm" width="48" height="48" />
                            </a>
                            <div className="d-flex flex-wrap w-100">
                                <div className="ml-2 d-flex flex-column">
                                    <p className="mb-0">{user.name}</p>
                                    <span className="text-secondary small">{user.screen_name}</span>
                                    <p className="small">フォロワー<span className="badge badge-blog badge-pill text-white ml-1">{user.followers.length}</span></p>
                                </div>
                                {/* フォローボタン */}
                                {
                                    user.id !== loginUser.id ? <div className="ml-auto"><FollowButton user={user} loginUser={loginUser} root={root} /></div> : ''
                                }
                            </div>
                        </div>
                    </div>
                    <div className="card-body d-flex">
                        {/* 自己紹介文 */}
                        <p>{omittedText(user.description, 100)}</p>
                    </div>
                </div>
            )
            }
        </>
    )
}

export default Users
