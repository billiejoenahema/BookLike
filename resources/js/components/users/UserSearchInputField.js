import React from 'react';

const UserSearchInputField = ({ value, handleSearch }) => {
  return (
    <input
      className="form-control col-5 col-sm-4 col-md-3 col-lg-2 user-search-form rounded-pill pr-0"
      type="search"
      value={value}
      onChange={handleSearch}
      placeholder="ユーザー検索..."
      aria-label="ユーザー検索"
      required
      autoComplete="on"
    />
  );
};

export default UserSearchInputField;
