import React from 'react'
import ReactTooltip from 'react-tooltip'
import FavoriteButton from './FavoriteButton'
import EditReviewButton from './EditReviewButton'
import Ratings from './Ratings'
import Spoiler from './Spoiler'
import ReviewsCount from '../users/ReviewsCount'
import FollowerCount from '../users/FollowerCount'
import TotalFavoritesCount from '../users/TotalFavoritesCount'
import hoverUserIcon from '../../functions/hoverUserIcon'
import leaveUserIcon from '../../functions/leaveUserIcon'
import { STORAGE } from '../../constants'

const Reviews = (props) => {

    const { reviews, loginUser } = props
    const currentUrl = window.location.pathname
    const internalLinks = document.querySelectorAll('.internal-link')

    // ユーザー詳細画面では「カテゴリー」のcssをリセット（押しても何も起きないため）
    if (currentUrl.includes('/users/')) {
        internalLinks.forEach(internalLink => {
            internalLink.classList.remove('btn', 'text-blog', 'internal-link')
        })
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
                                <TotalFavoritesCount user={review.user} favorites_count={review.user.favorites_count} />
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
                                <img src={review.image_url} width="104" className="shadow-sm" />
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
                                    <li><span>カテゴリー：</span><span className="btn p-0 text-blog internal-link" onClick={props.changeCategory} data-category={review.category}>{review.category}</span></li>
                                    <li className="mt-2"><span>評価 </span><Ratings ratings={review.ratings} /></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">
                        {/* レビュー詳細 */}
                        <div className="flex-grow-1">
                            <a href={`/reviews/${review.id}`} className="align-text-top text-blogDark internal-link"><i className="fas fa-angle-right"></i>レビューをみる </a><Spoiler spoiler={review.spoiler} />
                        </div>
                        {/* 投稿を編集 */}
                        <div className="d-d-flex align-items-center">
                            {loginUser.id === review.user.id && <EditReviewButton review={review} />}
                        </div>
                        {/* コメントボタン */}
                        <div className="ml-sm-3 d-flex align-items-center">
                            <a href={`/reviews/${review.id}`}><i className="far fa-comment fa-fw text-blogDark"></i></a>
                            <p className="mb-0 text-secondary">{review.comments_count}</p>
                        </div>
                        {/* いいねボタン */}
                        <div className="ml-3 ml-sm-4 mr-sm-3 d-flex align-items-center">
                            <FavoriteButton review={review} loginUser={loginUser} />
                        </div>
                    </div>
                </div>
            ))}
        </>
    )
}

export default Reviews
