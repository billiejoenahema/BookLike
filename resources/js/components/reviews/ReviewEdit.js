import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useFetchLoginUser } from '../../hooks/useFetchLoginUser';
import { useFetchReview } from '../../hooks/useFetchReview';
import UserIcon from '../users/UserIcon';
import UserName from '../users/UserName';
import BookImage from './BookImage';
import BookInfo from './BookInfo';
import ReviewSpoiler from './ReviewSpoiler';
import ReviewEditButton from './ReviewEditButton';
import CommentButton from './CommentButton';
import CreatedAt from '../CreatedAt';
import FavoriteButton from './FavoriteButton';
import Loading from '../Loading';

const ReviewEdit = () => {
  const { getLoginUser, loginUser } = useFetchLoginUser();
  const { getReview, review } = useFetchReview();
  const [textLength, setTextLength] = useState(0);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const getData = async () => {
      setLoading(true);
      await getLoginUser();
      await getReview(currentUrl);
    };
    getData;
    setLoading(false);
  }, []);

  const checkTextLength = (e) => {
    setTextLength(e.target.value.length);
  };

  return (
    <div>
      {loading ? (
        <Loading />
      ) : (
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
              <UserIcon
                reviewUser={review.user}
                favoritesCount={review.favorites_count}
                reviewId={review.id}
                profileImage={review.user.profile_image}
                iconSize={48}
              />
              <UserName
                userName={loginUser.name}
                screenName={loginUser.screen_name}
              />
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
                      編集を保存
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default ReviewEdit;

if (document.getElementById('reviewEdit')) {
  ReactDOM.render(<ReviewEdit />, document.getElementById('reviewEdit'));
}
