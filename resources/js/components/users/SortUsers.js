import React from 'react'

const SortUsers = ({ sortChange }) => {
  return (
    <div className="form-group d-flex justify-content-end pt-2 sort-changer">
      <div className="d-flex flex-row col-8 p-0">
        <label htmlFor="selectSort" className="w-100 text-right py-1 mr-1 mb-0">並び替え</label>
        <select onChange={sortChange} className="form-control-sm" id="selectSort">
          <option value="default">登録順</option>
          <option value="review">投稿数</option>
          <option value="follower">フォロワー数</option>
          <option value="favorite">いいね獲得数</option>
        </select>
      </div>
    </div>
  )
}

export default SortUsers
