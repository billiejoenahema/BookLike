import React from 'react'

const SearchCriteriaAndWord = ({ criteria, searchWord }) => {

  const criterion = {
    title: 'タイトル',
    author: '著者',
    manufacturer: '出版社'
  }

  return (
    <span>
      {criterion[criteria]}で検索: {searchWord}
    </span>
  )
}

export default SearchCriteriaAndWord
