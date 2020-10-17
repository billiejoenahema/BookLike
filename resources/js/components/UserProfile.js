import React from 'react'
import FollowButton from './FollowButton'

const UserProfile = (props) => {
    const profileUser = props.profileUser
    const loginUser = props.loginUser

    return (
        <div className="card shadow-sm mb-5">
            <div className="d-inline-flex">
                <div className="col-4 p-3 d-flex flex-column">
                    <a href={`http://127.0.0.1:8000/users/${profileUser.id}`}>
                        <img src={`/storage/profile_image/${profileUser.profile_image}`} className="rounded-circle shadow-sm" width="100" height="100" />

                    </a>
                    <div className="mt-3 d-flex flex-column">
                        <h4 className="mb-0 font-weight-bold">{profileUser.name}</h4>
                        <span className="text-secondary">{profileUser.screen_name}</span>
                    </div>
                </div>
                <div className="col-8 p-3 d-flex flex-column justify-content-between">
                    <div className="d-flex flex-wrap justify-content-sm-between justify-content-end mb-3">
                        <div className="d-flex flex-sm-column">
                            {
                                isFollowed(loginUser, profileUser) ?
                                    <div className="mb-1 ml-5"><span className="text-secondary"><i className="far fa-laugh"></i>フォローされています</span></div>
                                    : ''
                            }
                        </div>
                        {
                            profileUser.id !== loginUser.id ? <div className="ml-auto"><FollowButton user={profileUser} loginUser={loginUser} /></div> : ''
                        }
                    </div>
                    <div className="d-flex">
                        <p>{profileUser.description}</p>
                    </div>
                </div>
            </div>

            <div className="card-footer border-top-0 d-flex flex-row justify-content-around">
                <div className="d-flex flex-column align-items-center p-1">
                    <span className="font-weight-bold small mb-1">投稿</span>
                    RC
                </div>
                <div className="d-flex flex-column align-items-center p-1">
                    <span className="font-weight-bold small mb-1">いいねした投稿</span>
                    FRC
                </div>
                <div className="d-flex flex-column align-items-center p-1">
                    <span className="font-weight-bold small mb-1">フォロー</span>
                    FC
                </div>
                <div className="d-flex flex-column align-items-center p-1">
                    <span className="font-weight-bold small mb-1">フォロワー</span>
                    FC
                </div>
            </div>
        </div>
    )
}

export default UserProfile

