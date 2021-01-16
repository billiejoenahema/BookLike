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
import { STORAGE } from '../../constants'

const ShowReview = () => {

    const [loginUser, setLoginUser] = useState()
    const [review, setReview] = useState('')
    const currentUrl = window.location.pathname

    useEffect(() => {
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
        loadReview()
    }, [])

    const hoverUserIcon = (e) => {
        const id = e.target.dataset.id
        const userCountsDiv = document.getElementsByClassName(`review-${id}`)[0]
        // ユーザーアイコンにマウスポインターが乗ったら表示する
        setTimeout(() => {
            userCountsDiv.classList.remove('d-none')
        }, 300)
    }

    const leaveUserIcon = (e) => {
        const id = e.target.dataset.id
        const userCountsDiv = document.getElementsByClassName(`review-${id}`)[0]
        // ユーザーアイコンからマウスポインターが外れたら非表示にする
        userCountsDiv.classList.add('d-none')
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
                            {/* 書籍イメージ */}
                            <div>
                                <img src={review.image_url} width="128" className="shadow-sm" />
                            </div>
                            {/* 書籍情報 */}
                            <div className="col-md-8 d-flex flex-column text-left pl-3 px-0">
                                <h5 className="mb-3">{review.title}</h5>
                                <ul className="list-unstyled">
                                    <li><span>著者：</span>{review.author}</li>
                                    <li><span>出版社：</span>{review.manufacturer}</li>
                                    <li><span>カテゴリー：</span><span className="p-0">{review.category}</span></li>
                                    <li>
                                        <object><a href={review.page_url} target="_blank" rel="noopener" data-tip="Amazonサイトへ移動">
                                            <i className="fab fa-amazon"></i> Amazon
                                                <ReactTooltip effect="float" type="info" place="top" />
                                        </a></object>
                                    </li>
                                    <li data-tip={review.ratings}><span>評価 </span><Ratings ratings={review.ratings} /></li>
                                    <li><Spoiler spoiler={review.spoiler} /></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="card-body p-3">
                        {review.text}
                    </div>
                    <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">
                        {/* 投稿を編集 */}
                        {loginUser.id === review.user.id && <EditReviewButton review={review} />}
                        {/* コメントボタン */}
                        <div className="d-flex align-items-center">
                            <span><i className="far fa-comment fa-fw text-blog"></i></span>
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
