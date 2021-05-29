import React from 'react'
import UserIcon from '../users/UserIcon'
import UserInfo from '../users/UserInfo'
import BookImage from './BookImage'
import BookInfo from './BookInfo'
import Spoiler from './Spoiler'
import ShowReviewLink from './ShowReviewLink'
import EditReviewButton from './EditReviewButton'
import CommentButton from './CommentButton'
import FavoriteButton from './FavoriteButton'
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
            <UserIcon
              reviewUser={review.user}
              favoritesCount={review.user.favorites_count}
              reviewId={review.id}
              profileImage={review.user.profile_image}
              hoverUserIcon={hoverUserIcon}
              leaveUserIcon={leaveUserIcon}
            />
            <UserInfo
              userName={review.user.name}
              screenName={review.user.screen_name}
              created_at={review.created_at}
            />
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
            <div className="flex-grow-1">
              <ShowReviewLink id={review.id} />
              <Spoiler spoiler={review.spoiler} />
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
