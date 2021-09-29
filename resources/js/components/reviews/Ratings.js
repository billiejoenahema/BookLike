import React from 'react';

const Ratings = ({ ratings }) => {
  const defaultStars = ['fas', 'fas', 'fas', 'fas', 'fas']; // 星5つ
  const stars = defaultStars.fill('far', ratings);

  return (
    <>
      {stars.map((star, index) => (
        <span className="text-mango" key={index}>
          {' '}
          <i className={`${star} fa-star`}></i>
        </span>
      ))}
    </>
  );
};

export default Ratings;
