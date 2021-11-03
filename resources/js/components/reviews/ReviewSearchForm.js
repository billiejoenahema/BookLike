import React from 'react';

const ReviewSearchForm = ({ selectCriteria, searchSubmit }) => {
  const fadeLayer = document.getElementById('fadeLayer');
  const showOverlay = () => {
    fadeLayer.style.visibility = 'visible';
  };
  const hideOverlay = () => {
    fadeLayer.style.visibility = 'hidden';
  };

  return (
    <div className="search-form">
      <div className="d-flex flex-row">
        <select
          onChange={selectCriteria}
          className="text-right text-graphite bg-transparent border-0 mr-1"
        >
          <option value="title">タイトル</option>
          <option value="author">著者</option>
          <option value="manufacturer">出版社</option>
        </select>
        <form onSubmit={searchSubmit}>
          <input
            onFocus={showOverlay}
            onBlur={hideOverlay}
            className="form-control rounded-pill pr-0"
            id="searchBooks"
            type="search"
            name="search"
            placeholder="タイトルで検索..."
            aria-label="書籍検索"
            autoComplete="off"
          />
        </form>
      </div>
    </div>
  );
};

export default ReviewSearchForm;
