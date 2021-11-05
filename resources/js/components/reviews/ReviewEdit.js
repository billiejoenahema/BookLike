import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useFetchLoginUser } from '../../hooks/useFetchLoginUser';
import UserIcon from '../users/UserIcon';
import UserName from '../users/UserName';
import BookImage from './BookImage';
import BookInfo from './BookInfo';
import ReviewSpoiler from './ReviewSpoiler';
import ReviewEditButton from './ReviewEditButton';
import CommentButton from './CommentButton';
import CreatedAt from '../CreatedAt';
import FavoriteButton from './FavoriteButton';
import { hoverUserIcon } from '../../functions/hoverUserIcon';
import { leaveUserIcon } from '../../functions/leaveUserIcon';

const ReviewEdit = () => {
  const [review, setReview] = useState({});
  const [textLength, setTextLength] = useState(0);
  const { getLoginUser, loginUser } = useFetchLoginUser();
  const ratingStarMax = 5;
  const currentUrl = window.location.pathname;

  useEffect(() => {
    loadReview();
  }, []);

  const loadReview = async () => {
    await getLoginUser();
    await axios
      .get(`/api${currentUrl}/edit`)
      .then((res) => {
        setReview(res.review);
      })
      .catch((err) => {
        console.log(err);
      });
  };

  const checkTextLength = (e) => {
    setTextLength(e.target.value.length);
  };

  return (
    <div className="card shadow-sm">
      <form>
        <div
          className="card-header
                d-flex
                align-items-center
                justify-content-between"
        >
          <div className="h5 mb-0">編集</div>
          <a
            href="#"
            role="button"
            data-toggle="modal"
            data-target="#deleteReview"
            title="投稿を削除"
            className="text-secondary mb-0 d-block h5"
          >
            <i className="fas fa-trash"></i>
          </a>
        </div>
      </form>
      <div className="card-body">
        <div className="pr-3 pb-3 w-100 d-flex">
          {/* <UserIcon /> */}
          <div className="ml-2 d-flex flex-column">
            <p className="mb-0">{loginUser.name}</p>
            <span className="text-secondary">{loginUser.screen_name}</span>
          </div>
        </div>
        <form>
          <div className="d-flex pt-2 border-top form-group mb-0">
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
            />
            <div className="col-md-8 d-flex flex-column text-left py-2 px-0">
              <div className="d-flex-column">
                <label className="d-flex mb-0">ネタバレ：</label>
                <ReviewSpoiler spoiler={review.spoiler} />
              </div>
            </div>
          </div>
          <div className="form-group row mb-0">
            <div className="col-md-12">
              <label className="d-inline text-blog font-weight-bold">
                レビュー
              </label>
              <textarea
                className="form-control"
                name="text"
                autoComplete="text"
                rows="6"
                onKeyUp={(e) => checkTextLength()}
              >
                {review.text}
              </textarea>
              <span className="invalid-feedback" role="alert">
                <strong>800文字まで投稿可能です</strong>
              </span>
            </div>
          </div>

          <div className="form-group row mb-0">
            <div className="col-md-12 text-right">
              <p>{textLength} / 800文字</p>
              <div className="w-100 m-0 row justify-content-end">
                <button
                  type="button"
                  className="btn btn-secondary rounded-pill"
                >
                  キャンセル
                </button>
                <button
                  type="submit"
                  className="btn btn-primary rounded-pill shadow-sm ml-4"
                >
                  投稿を編集する
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  );
};

export default ReviewEdit;

if (document.getElementById('reviewEdit')) {
  ReactDOM.render(<ReviewEdit />, document.getElementById('reviewEdit'));
}
