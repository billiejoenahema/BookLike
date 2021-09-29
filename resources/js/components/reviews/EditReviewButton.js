import React from 'react';

const EditReviewButton = ({ loginUser, reviewUser, id }) => {
  return (
    <>
      {loginUser === reviewUser ? (
        <a href={`/reviews/${id}/edit`} className="edit text-secondary pr-2">
          <span className="edit-text">
            <i className="fas fa-fw fa-edit"></i>
            編集
          </span>
        </a>
      ) : (
        ''
      )}
    </>
  );
};

export default EditReviewButton;
