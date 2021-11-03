import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import FavoritesCountTotal from './FavoritesCountTotal';

const FavoritesCountTotalWrapper = () => {
  const [totalFavoritesCount, setTotalFavoritesCount] = useState(0);
  const currentPath = window.location.pathname;
  const id = currentPath.replace(/[^0-9]/g, '');

  useEffect(() => {
    // ユーザー詳細ページ用のいいね獲得数を取得
    loadFavoritesCount();
  }, []);

  const loadFavoritesCount = async () => {
    await axios
      .get(`/api/users/${id}`)
      .then((res) => {
        const userReviews = res.data.userReviews;
        const total = userReviews.reduce((a, b) => a + b.favorites.length, 0);
        setTotalFavoritesCount(total);
      })
      .catch((err) => {
        console.log(err);
      });
  };

  return (
    <>
      <FavoritesCountTotal favoritesCount={totalFavoritesCount} />
    </>
  );
};
export default FavoritesCountTotalWrapper;
if (document.getElementById('favoritesCountTotalWrapper')) {
  ReactDOM.render(
    <FavoritesCountTotalWrapper />,
    document.getElementById('favoritesCountTotalWrapper')
  );
}
