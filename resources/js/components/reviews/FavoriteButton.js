import React, { useState, useCallback } from 'react';
import { favoriteAnimation } from '../../functions/favoriteAnimation';
import { isFavorited } from '../../functions/isFavorited';

const FavoriteButton = ({ review, loginUser }) => {
  const InitialFavorite = isFavorited(review, loginUser);
  const InitialCount = review.favorites.length;
  const [favorite, setFavorite] = useState(InitialFavorite);
  const [favoriteCount, setFavoriteCount] = useState(InitialCount);
  const reviewId = review.id;

  const toggleFavorite = useCallback(
    () => setFavorite((prev) => !prev),
    [setFavorite]
  );

  const addFavorite = (e) => {
    const heartClassList = e.target.classList;
    favoriteAnimation(heartClassList);
    // アニメーションの時間分だけ待ってから実行
    setTimeout(() => {
      toggleFavorite();
      setFavoriteCount(favoriteCount + 1);
    }, 200);
    axios
      .post(`/api/favorites/${reviewId}`)
      .then(console.log('success!'))
      .catch((err) => {
        console.log(err);
        // リクエストに失敗した時はボタンのUIを元に戻す
        toggleFavorite();
      });
  };
  const removeFavorite = () => {
    toggleFavorite();
    setFavoriteCount(favoriteCount - 1);
    axios
      .delete(`/api/favorites/${reviewId}`)
      .then(console.log('success!'))
      .catch((err) => {
        console.log(err);
        // リクエストに失敗した時はボタンのUIを元に戻す
        toggleFavorite();
      });
  };

  return (
    <>
      {favorite ? (
        <div onClick={removeFavorite} role="btn">
          <i className="text-red fas fa-heart fa-fw"></i>
        </div>
      ) : (
        <div onClick={addFavorite} role="btn">
          <i className="text-blogDark far fa-heart fa-fw"></i>
        </div>
      )}

      <p className="mb-0 text-secondary">{favoriteCount}</p>
    </>
  );
};

export default FavoriteButton;
