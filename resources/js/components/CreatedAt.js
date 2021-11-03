import React from 'react';

const CreatedAt = ({ createdAt }) => {
  return (
    <div className="d-flex justify-content-end flex-grow-1">
      <p className="mb-0 text-secondary">
        {formatDate(createdAt, 'yyyy/MM/dd')}
      </p>
    </div>
  );
};

export default CreatedAt;
