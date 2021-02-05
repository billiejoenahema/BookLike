import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import ReactTooltip from 'react-tooltip'
import FavoriteButton from './FavoriteButton'
import EditReviewButton from './EditReviewButton'
import Ratings from './Ratings'
import Spoiler from './Spoiler'
import ReviewsCount from '../users/ReviewsCount'
import FollowerCount from '../users/FollowerCount'
import TotalFavoritesCount from '../users/TotalFavoritesCount'
import { hoverUserIcon } from '../../functions/hoverUserIcon'
import { leaveUserIcon } from '../../functions/leaveUserIcon'
import { STORAGE } from '../../constants'

const ShowReview = () => {

    const [loginUser, setLoginUser] = useState()
    const [review, setReview] = useState('')
    const currentUrl = window.location.pathname

    useEffect(() => {
        loadReview()
        return () => { }
    }, [])

    const loadReview = async () => {
        await axios
            .get(`/api${currentUrl}`)
            .then(res => {
                setLoginUser(res.data.loginUser)
                setReview(res.data.review)
            })
            .catch(err => {
                console.log(err)
            })
    }

    return (
        <>
            {review && loginUser &&
                (<div className="card shadow-sm mb-3">
                    <div className="card-haeder p-3 d-flex">
                        {/* ユーザー情報 */}
                        <div className={`user-counts shadow-sm d-none review-${review.id}`} >
                            <div className="count d-flex justify-content-between mb-1">
                                <ReviewsCount user={review.user} />
                            </div>
                            <div className="count d-flex justify-content-between mb-1">
                                <FollowerCount user={review.user} />
                            </div>
                            <div className="count d-flex justify-content-between">
                                <TotalFavoritesCount user={review.user} />
                            </div>
                        </div>
                        {/* ユーザーアイコン */}
                        <a href={`/users/${review.user.id}`} className="text-reset">
                            <img src={`${STORAGE}/${review.user.profile_image}`}
                                className="rounded-circle shadow-sm"
                                width="48" height="48"
                                data-id={review.id}
                                onMouseEnter={hoverUserIcon}
                                onMouseLeave={leaveUserIcon}
                            />
                        </a>
                        {/* ユーザーネーム */}
                        <div className="ml-2 d-flex flex-column">
                            <p className="mb-0">{review.user.name || review.user.screen_name}</p>
                            <span className="text-secondary">{review.user.screen_name}</span>
                        </div>
                        {/* 登録日 */}
                        <div className="d-flex justify-content-end flex-grow-1">
                            <p className="mb-0 text-secondary">{formatDate(review.created_at, 'yyyy/MM/dd')}</p>
                        </div>
                    </div>
                    <div className="card-body py-0 px-3">
                        <div className="d-flex flex-row py-3 border-top border-bottom">
                            <div className="flex-column text-center">
                                {/* 書籍イメージ */}
                                <img src={review.image_url} width="128" className="d-block shadow-sm" />
                                {/* Amazonリンク */}
                                <a href={review.page_url} className="d-block pt-1 amazon-link" target="_blank" rel="noopener" data-tip="Amazonサイトへ移動">
                                    <i className="fab fa-amazon"></i> Amazon
                                    <ReactTooltip effect="float" type="info" place="top" />
                                </a>
                            </div>
                            {/* 書籍情報 */}
                            <div className="col-md-8 d-flex flex-column text-left pl-3 px-0">
                                <h5 className="mb-3">{review.title}</h5>
                                <ul className="list-unstyled mb-0">
                                    <li><span>著者：</span>{review.author}</li>
                                    <li><span>出版社：</span>{review.manufacturer}</li>
                                    <li><span>カテゴリー：</span><span className="p-0">{review.category}</span></li>
                                    <li className="mt-2"><span>評価 </span><Ratings ratings={review.ratings} /></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {/* レビュー */}
                    <div className="card-body border-bottom py-3 px-0 mx-3">
                        <div className="d-inline text-blog font-weight-bold">
                            レビュー <Spoiler spoiler={review.spoiler} />
                        </div>
                        <p className="mt-1 mb-0">{review.text || '未投稿'}</p>
                    </div>
                    <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">
                        {/* 投稿を編集 */}
                        {loginUser.id === review.user.id && <EditReviewButton review={review} />}
                        {/* コメントボタン */}
                        <div className="ml-3 d-flex align-items-center">
                            <span><i className="far fa-comment fa-fw text-blog internal-link"></i></span>
                            <p className="mb-0 text-secondary">{review.comments_count}</p>
                        </div>
                        {/* いいねボタン */}
                        <div className="ml-4 mr-3 d-flex align-items-center">
                            <FavoriteButton review={review} loginUser={loginUser} />
                        </div>
                    </div>
                </div>)
            }
        </>
    )
}

export default ShowReview

if (document.getElementById('showReview')) {
    ReactDOM.render(<ShowReview />, document.getElementById('showReview'))
}
