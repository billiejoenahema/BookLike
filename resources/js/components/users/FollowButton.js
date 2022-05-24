import React, { useState, useCallback } from 'react';
import { isFollowed } from '../../functions/isFollowed';

const FollowButton = ({ user, loginUser }) => {
  const InitialFollowState = isFollowed(user, loginUser);
  const [following, setFollowing] = useState(InitialFollowState);

  const postFollow = () => {
    axios
      .post(`/api/follows/${user.id}`)
      .then(console.log('success!'))
      .catch((err) => {
        console.log(err);
        // リクエストに失敗した時はボタンのUIを元に戻す
        toggleFollow();
      });
  };
  const deleteFollow = () => {
    axios
      .delete(`/api/follows/${user.id}`)
      .then(console.log('success!'))
      .catch((err) => {
        console.log(err);
        // リクエストに失敗した時はボタンのUIを元に戻す
        toggleFollow();
      });
  };

  const toggleFollow = useCallback(
    () => setFollowing((prev) => !prev),
    [setFollowing]
  );

  const attachFollow = () => {
    toggleFollow();
    postFollow();
  };
  const detachFollow = () => {
    toggleFollow();
    deleteFollow();
  };

  return (
    <>
      {following ? (
        <div
          onClick={attachFollow}
          className='btn-sm btn-blog rounded-pill shadow-sm border-0 unfollow-btn'
        >
          フォロー中
        </div>
      ) : (
        <div
          onClick={detachFollow}
          className='btn-sm btn-outline-blog rounded-pill shadow-sm border-0 follow-btn'
        >
          フォローする
        </div>
      )}
    </>
  );
};

export default FollowButton;
