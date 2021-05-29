import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import UserIcon from '../users/UserIcon'
import UserInfo from '../users/UserInfo'
import BookImage from './BookImage'
import BookInfo from './BookInfo'
import Spoiler from './Spoiler'
import EditReviewButton from './EditReviewButton'
import CommentButton from './CommentButton'
import FavoriteButton from './FavoriteButton'
import { hoverUserIcon } from '../../functions/hoverUserIcon'
import { leaveUserIcon } from '../../functions/leaveUserIcon'

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
          <div className="p-3 d-flex">
            {/* ユーザー情報 */}
            <UserIcon
              reviewUser={review.user}
              favoritesCount={review.user.favorites_count}
              reviewId={review.id}
              profileImage={review.user.profile_image}
              hoverUserIcon={hoverUserIcon}
              leaveUserIcon={leaveUserIcon}
              iconSize={48}
            />
            <UserInfo
              userName={review.user.name}
              screenName={review.user.screen_name}
              created_at={review.created_at}
            />
          </div>

          <div className="card-body py-0 px-3">
            <div className="d-flex flex-row py-3 border-top border-bottom">
              <BookImage
                imageUrl={review.image_url}
                pageUrl={review.page_url}
                bookImageSize={128}
              />
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

          {/* レビュー */}
          <div className="card-body border-bottom py-3 px-0 mx-3">
            <div className="d-inline text-blog font-weight-bold">
              レビュー <Spoiler spoiler={review.spoiler} />
            </div>
            <p className="mt-1 mb-0">{review.text || '未投稿'}</p>
          </div>

          <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">
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
        </div>)
      }
    </>
  )
}

export default ShowReview

if (document.getElementById('showReview')) {
  ReactDOM.render(<ShowReview />, document.getElementById('showReview'))
}
