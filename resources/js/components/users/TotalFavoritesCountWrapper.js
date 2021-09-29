import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import TotalFavoritesCount from './TotalFavoritesCount';

const TotalFavoritesCountWrapper = () => {
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
      <TotalFavoritesCount favoritesCount={totalFavoritesCount} />
    </>
  );
};
export default TotalFavoritesCountWrapper;
if (document.getElementById('totalFavoritesCountWrapper')) {
  ReactDOM.render(
    <TotalFavoritesCountWrapper />,
    document.getElementById('totalFavoritesCountWrapper')
  );
}
