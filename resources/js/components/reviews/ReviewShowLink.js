import React from 'react';

const ReviewShowLink = ({ id }) => {
  return (
    <>
      <a
        href={`/reviews/${id}`}
        className="align-text-top text-blogDark internal-link mr-1"
      >
        <i className="fas fa-angle-right"></i>レビューをみる
      </a>
    </>
  );
};

export default ReviewShowLink;
