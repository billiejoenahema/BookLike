import React from 'react'

const CommentButton = ({ id, commentCount }) => {
  return (
    <>
      <a href={`/reviews/${id}`}><i className="far fa-comment fa-fw text-blogDark comment-button"></i></a>
      <p className="mb-0 text-secondary">{commentCount}</p>
    </>
  )
}

export default CommentButton
