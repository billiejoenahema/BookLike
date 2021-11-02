import React from 'react';
import CommentItem from './CommentItem';

const CommentList = ({ comments, loginUser }) => {
  return (
    <div>
      <h6 id="comment" className="mt-4">
        コメント
      </h6>
      <ul className="list-group">
        {comments &&
          comments.map((comment) => (
            <li className="list-group-item p-0" key={comment.id}>
              <CommentItem comment={comment} loginUser={loginUser} />
            </li>
          ))}
        <li className="list-group-item">
          <p className="mb-0 text-secondary">コメントはまだありません</p>
        </li>
      </ul>
    </div>
  );
};

export default CommentList;
