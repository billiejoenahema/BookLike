import React from 'react'
import ReactTooltip from 'react-tooltip'
import FavoriteButton from './FavoriteButton'
import EditReviewButton from './EditReviewButton'
import ReviewsCount from '../users/ReviewsCount'
import FollowerCount from '../users/FollowerCount'
import TotalFavoritesCount from '../users/TotalFavoritesCount'
import omittedText from '../../functions/omittedText'

import { STORAGE } from '../../constants'

function Reviews(props) {

    const { reviews, loginUser } = props

    const hoverUserIcon = (e) => {
        const id = e.target.dataset.id
        const userCountsDiv = document.getElementsByClassName(`review-${id}`)[0]
        // ユーザーアイコンにマウスポインターが乗ったら表示する
        setTimeout(() => {
            userCountsDiv.classList.remove('d-none')
        }, 500)
    }

    const leaveUserIcon = (e) => {
        const id = e.target.dataset.id
        const userCountsDiv = document.getElementsByClassName(`review-${id}`)[0]
        // ユーザーアイコンからマウスポインターが外れたら非表示にする
        userCountsDiv.classList.add('d-none')
    }

    return (
        <>
            {reviews.map((review) => (
                <div className="card shadow-sm mb-3" key={review.id}>
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
                            <p className="mb-0 text-secondary">{formatDate(review.created_at, 'yyyy-MM-dd')}</p>
                        </div>
                    </div>
                    <div className="card-body py-0 px-3">
                        <div className="d-flex flex-row py-3 border-top border-bottom">
                            {/* 書籍イメージ */}
                            <a href={`/reviews/${review.id}`} className="d-block text-reset text-decoration-none" data-tip="投稿の詳細ページへ">
                                <div>
                                    <img src={review.image_url} width="100" className="shadow-sm" />
                                </div>
                                <ReactTooltip effect="float" type="info" place="top" />
                            </a>
                            {/* 書籍情報 */}
                            <div className="col-md-8 d-flex flex-column text-left pl-3 px-0">
                                <h5 className="mb-3">{review.title}</h5>
                                <ul className="list-unstyled">
                                    <li><span>著者：</span>{review.author}</li>
                                    <li><span>出版社：</span>{review.manufacturer}</li>
                                    <li><span>カテゴリー：</span><span className="btn p-0 text-blue anchor" onClick={props.changeCategory} data-category={review.category}>{review.category}</span></li>
                                    <li>
                                        <object><a href={review.page_url} target="_blank" rel="noopener" data-tip="Amazonサイトへ移動">
                                            <i className="fab fa-amazon"></i> Amazon
                                                <ReactTooltip effect="float" type="info" place="top" />
                                        </a></object>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="card-body p-0">
                        <a href={`/reviews/${review.id}`} className="d-block p-3 text-reset text-decoration-none" data-tip="投稿の詳細ページへ">
                            {omittedText(review.text, 80)}
                            <ReactTooltip effect="float" type="info" place="top" />
                        </a>
                    </div>
                    <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">
                        {/* 投稿を編集 */}
                        {loginUser.id === review.user.id && <EditReviewButton review={review} />}
                        {/* コメントボタン */}
                        <div className="d-flex align-items-center">
                            <a href={`/reviews/${review.id}`}><i className="far fa-comment fa-fw text-blog"></i></a>
                            <p className="mb-0 text-secondary">{review.comments.length}</p>
                        </div>
                        {/* いいねボタン */}
                        <div className="ml-4 mr-3 d-flex align-items-center">
                            <FavoriteButton review={review} loginUser={loginUser} />
                        </div>
                    </div>
                </div>
            ))}
        </>
    )
}

export default Reviews
