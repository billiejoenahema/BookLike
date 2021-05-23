import React from 'react'

const SortChange = ({ sortChange }) => {
  return (
    <div className="d-flex flex-row p-0 mt-1 mt-sm-0">
      <label htmlFor="selectSort" className="text-right py-1 mr-1 mb-0">並び替え</label>
      <select onChange={sortChange} className="form-control-sm" id="selectSort">
        <option value="default">新着順</option>
        <option value="favorite">いいね数</option>
        <option value="ratings">評価順</option>
      </select>
    </div>
  )
}

export default SortChange

