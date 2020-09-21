import React, { Fragment } from 'react'

const Users = (props) => {

    const isFollowed = (userId) => {

    }


    return (
        <Fragment>
            {props.Users.map((user) =>
                <div className="card mb-3 shadow-sm">
                    <div className="card-haeder p-3 w-100 d-flex">
                        <img src={`/storage/profile_image/${user.profile_image}`} className="rounded-circle shadow-sm" width="48" height="48" />
                        <div className="ml-2 d-flex flex-column">
                            <p className="mb-0">{user.name}</p>
                            <span className="text-secondary">{user.screen_name}</span>
                        </div>

                        {/* このユーザーにフォローされているかどうか */}
                        <div className="d-flex flex-column">
                            {
                                loginUser.isFollowed(user.id) ?
                                    <div className="px-2 mb-3"><span className="px-1 bg-secondary text-light rounded">フォローされています</span></div>
                                    : ''
                            }
                        </div>

                        {/* フォローボタン */}
                        <div className="d-flex justify-content-end ml-auto">
                            {
                                isFollowing(user.id) ?
                                    <button type="submit" className="btn-sm btn-primary shadow-sm rounded-pill">フォロー中</button>
                                    : <button type="submit" className="btn-sm btn-outline-primary shadow-sm rounded-pill">フォローする</button>
                            }
                        </div>
                    </div>
                    <div className="card-body">
                        {/* 自己紹介 */}
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
