import React from 'react';
import ReactTooltip from 'react-tooltip';

const BookImage = ({ imageUrl, pageUrl, bookImageSize }) => {
  return (
    <div className="flex-column text-center">
      {/* 書籍イメージ */}
      <img src={imageUrl} width={bookImageSize} className="shadow-sm" />
      {/* Amazonリンク */}
      <a
        href={pageUrl}
        className="d-block pt-1 amazon-link"
        target="_blank"
        rel="noopener"
        data-tip="Amazonサイトへ移動します"
      >
        <i className="fab fa-amazon"></i> Amazon
        <ReactTooltip effect="float" type="info" place="top" />
      </a>
    </div>
  );
};

export default BookImage;
