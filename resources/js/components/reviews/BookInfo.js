import React from 'react'
import Ratings from './Ratings'

const BookInfo = ({ title, author, manufacturer, category, ratings, changeCategory }) => {
  return (
    <div className="col-md-8 d-flex flex-column text-left pl-3 px-0">
      <h5 className="mb-3">{title}</h5>
      <ul className="list-unstyled mb-0">
        <li><span>著者：</span>{author}</li>
        <li><span>出版社：</span>{manufacturer}</li>
        <li><span>カテゴリー：</span>
          <span className="btn p-0 text-blog internal-link"
            onClick={changeCategory}
            data-category={category}
          >{category}</span>
        </li>
        <li className="mt-2"><span>評価 </span><Ratings ratings={ratings} /></li>
      </ul>
    </div>
  )
}

export default BookInfo
