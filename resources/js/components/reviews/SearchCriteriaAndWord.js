import React from 'react';

const SearchCriteriaAndWord = ({ criteria, searchWord }) => {
  const criterion = {
    title: 'タイトル',
    author: '著者',
    manufacturer: '出版社',
  };

  return (
    <div id="search-word-display" className="mt-2">
      {searchWord ? (
        <span>
          {criterion[criteria]}で検索: {searchWord}
        </span>
      ) : (
        ''
      )}
    </div>
  );
};

export default SearchCriteriaAndWord;
