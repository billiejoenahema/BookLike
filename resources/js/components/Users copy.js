import React, { Fragment, useState } from 'react'
import isFollowed from './isFollowed'


const Users = (props) => {

    const AllUsers = props.users
    const loginUser = props.loginUser

    return (
        <Fragment>
            {AllUsers.map((user) =>
                <div className="card mb-3 shadow-sm" key={user.id}>
                    <div className="card-haeder p-3 w-100 d-flex flex-column">
                        {
                            isFollowed(user, loginUser) ?
                                <div className="mb-1 ml-5"><span className="text-secondary"><i class="far fa-laugh"></i>フォローされています</span></div>
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
                                <div className="ml-auto">
                                    <FollowButton user={user} loginUser={loginUser} />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="card-body d-flex">
                        {/* 自己紹介文 */}
                        <p>{user.description}</p>
                    </div>
                </div>
            )
            }
        </Fragment>
    )
}

export default Users
