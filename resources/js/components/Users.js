import React, { Fragment, useState } from 'react'
import isFollowed from './isFollowed'

const Users = (props) => {
    return (
        <Fragment>
            {props.users.map((user) =>
                <div className="card mb-3 shadow-sm" key={user.id}>
                    <div className="card-haeder p-3 w-100 d-flex">
                        <a href={`http://127.0.0.1:8000/users/${user.id}`}>
                            <img src={`/storage/profile_image/${user.profile_image}`} className="rounded-circle shadow-sm" width="48" height="48" />
                        </a>
                        <div className="ml-2 d-flex flex-column">
                            <p className="mb-0">{user.name}</p>
                            <span className="text-secondary">{user.screen_name}</span>
                        </div>
                        {/* このユーザーにフォローされているかどうか */}
                        <div className="d-flex flex-column">
                            {
                                isFollowed(user, props.loginUser) ?
                                    <div className="px-2 mb-3"><span className="px-1 bg-secondary text-light rounded">フォローされています</span></div>
                                    : ''
                            }
                        </div>

                        {/* フォローボタン */}
                        {/* <div className="d-flex justify-content-end ml-auto">
                            {
                                isFollowing(user.id) ?
                                    <button type="submit" className="btn-sm btn-primary shadow-sm rounded-pill">フォロー中</button>
                                    : <button type="submit" className="btn-sm btn-outline-primary shadow-sm rounded-pill">フォローする</button>
                            }
                        </div> */}
                    </div>
                    <div className="card-body">
                        {/* 自己紹介文 */}
                        <div className="px-2">
                            <p>{user.description}</p>
                        </div>
                    </div>
                </div>
            )
            }
        </Fragment>
    )
}

export default Users
