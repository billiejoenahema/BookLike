import React from 'react';
import { STORAGE } from '../../constants';
import UserReviewsCount from '../users/UserReviewsCount';
import FollowerCount from '../users/FollowerCount';
import FavoritesCountTotal from '../users/FavoritesCountTotal';
import { hoverUserIcon } from '../../functions/hoverUserIcon';
import { leaveUserIcon } from '../../functions/leaveUserIcon';

const UserIcon = ({
  reviewUser,
  favoritesCount,
  reviewId,
  profileImage,
  iconSize,
}) => {
  const hoverUserIcon = () => {};
  const leaveUserIcon = () => {};

  return (
    <>
      {/* ツールチップ */}
      <div className={`user-counts shadow-sm d-none review-${reviewId}`}>
        <div className="count d-flex justify-content-between mb-1">
          <UserReviewsCount user={reviewUser} />
        </div>
        <div className="count d-flex justify-content-between mb-1">
          <FollowerCount user={reviewUser} />
        </div>
        <div className="count d-flex justify-content-between">
          <FavoritesCountTotal
            user={reviewUser}
            favoritesCount={favoritesCount}
          />
        </div>
      </div>
      {/* ユーザーアイコン */}
      <a href={`/users/${reviewUser.id}`} className="text-reset">
        <img
          src={
            `public/profile_image/${profileImage}` ??
            '/public/images/Default_User_Icon.jpeg'
          }
          className="rounded-circle shadow-sm"
          width={iconSize}
          height={iconSize}
          data-id={reviewId}
          onMouseEnter={hoverUserIcon}
          onMouseLeave={leaveUserIcon}
        />
      </a>
    </>
  );
};

export default UserIcon;
