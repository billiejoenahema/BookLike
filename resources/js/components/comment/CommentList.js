import React from 'react';
import UserIcon from '../users/UserIcon';

const CommentList = () => {
  return (
    <div>
      <h6 id="comment" className="mt-4">
        コメント
      </h6>
      <ul className="list-group">
        {comments.map((comment) => {
          <li className="list-group-item p-0">
            <CommentItem comment={comment} />
          </li>;
        })}
        <li className="list-group-item">
          <p className="mb-0 text-secondary">コメントはまだありません</p>
        </li>
      </ul>
    </div>
  );
};

export default CommentList;
