import React from 'react'
import ReviewsCount from '../users/ReviewsCount'
import FollowerCount from '../users/FollowerCount'
import TotalFavoritesCount from '../users/TotalFavoritesCount'
import BookImage from './BookImage'
import BookInfo from './BookInfo'
import Spoiler from './Spoiler'
import EditReviewButton from './EditReviewButton'
import CommentButton from './CommentButton'
import FavoriteButton from './FavoriteButton'
import UserIcon from '../users/UserIcon'
import { hoverUserIcon } from '../../functions/hoverUserIcon'
import { leaveUserIcon } from '../../functions/leaveUserIcon'

const Reviews = ({ reviews, loginUser, changeCategory }) => {

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
          <div className="p-3 d-flex">
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
            <UserIcon
              reviewId={review.id}
              reviewUser={review.user}
              hoverUserIcon={hoverUserIcon}
              leaveUserIcon={leaveUserIcon}
            />
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
              <BookImage imageUrl={review.image_url} pageUrl={review.page_url} />
              <BookInfo
                title={review.title}
                author={review.author}
                manufacturer={review.manufacturer}
                category={review.category}
                ratings={review.ratings}
                changeCategory={changeCategory}
              />
            </div>
          </div>
          <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">
            {/* レビュー詳細ページへのリンク */}
            <div className="flex-grow-1">
              <a href={`/reviews/${review.id}`} className="align-text-top text-blogDark internal-link"><i className="fas fa-angle-right"></i>レビューをみる </a><Spoiler spoiler={review.spoiler} />
            </div>
            <div className="d-d-flex align-items-center">
              <EditReviewButton loginUser={loginUser.id} reviewUser={review.user.id} id={review.id} />
            </div>
            <div className="ml-sm-3 d-flex align-items-center">
              <CommentButton id={review.id} commentCount={review.comments_count} />
            </div>
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
