import React from 'react'

const ShowReviewLink = ({ id }) => {
  return (
    <>
      {/* レビュー詳細ページへのテキストリンク */}
      <a href={`/reviews/${id}`} className="align-text-top text-blogDark internal-link mr-1">
        <i className="fas fa-angle-right"></i>レビューをみる
      </a>
    </>
  )
}

export default ShowReviewLink
