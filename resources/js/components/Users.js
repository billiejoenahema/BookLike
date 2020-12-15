import React from 'react'
import ReactTooltip from 'react-tooltip'
import FollowButton from './FollowButton'
import FollowerCount from './FollowerCount'
import TotalFavoritesCount from './TotalFavoritesCount'
import isFollowed from '../functions/isFollowed'
import omittedText from '../functions/omittedText'
import { STORAGE } from '../constants'

const Users = (props) => {

    const { users, loginUser } = props

    return (
        <>
            {users.map((user) =>
                <div className="card mb-3 shadow-sm" key={user.id}>
                    <div className="card-haeder pt-3 px-3 pb-0 d-flex flex-row justify-content-end">
                        {
                            isFollowed(loginUser, user) ?
                                <div className="text-secondary mr-1 mr-sm-2 mr-md-3 mr-lg-4"><i className="far fa-laugh"></i>フォローされています</div>
                                : ''
                        }
                        {/* フォローボタン */}
                        {
                            user.id !== loginUser.id ? <FollowButton user={user} loginUser={loginUser} /> : ''
                        }
                    </div>
                    <div className="mx-3 pt-2 pb-3 d-flex border-bottom">
                        <a href={`/users/${user.id}`}>
                            <img src={`${STORAGE}/${user.profile_image}`} className="rounded-circle shadow-sm" width="48" height="48" />
                        </a>
                        <div className="ml-2 px-0 flex-column">
                            <p className="mb-0">{user.name || user.screen_name}</p>
                            <span className="text-secondary small font-weight-lighter">{user.screen_name}</span>
                        </div>
                        <div className="px-0 flex-comlumn ml-auto text-right">
                            <FollowerCount user={user} />
                            <div className="mt-2">
                                <TotalFavoritesCount user={user} />
                            </div>
                        </div>
                    </div>
                    <div className="px-3 pt-3 flex-column">
                        <a href={`/users/${user.id}`} className="text-reset">
                            <div className="flex-column">
                                <span className="font-weight-bold">好きなジャンル</span>
                                <p>{omittedText(user.category, 50)}</p>
                            </div>
                            <div className="flex-column">
                                <span className="font-weight-bold">自己紹介</span>
                                <p>{omittedText(user.description, 50)}</p>
                            </div>
                        </a>
                    </div>
                </div>
            )
            }
        </>
    )
}

export default Users
