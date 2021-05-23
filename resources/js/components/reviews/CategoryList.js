import React from 'react'

const CategoryList = ({ changeCategory, sortChange }) => {
  return (
    <div className="form-group d-flex flex-wrap justify-content-between pt-2 pb-0 bg-body category-selector">
      {/* カテゴリー選択 */}
      <select onChange={changeCategory} id="categorySelector" className="form-control-sm mt-1 mt-sm-0" placeholder="カテゴリーで絞り込み">
        <option value="default">すべてのカテゴリー</option>
        <option value="文学">文学</option>
        <option value="エンターテインメント">エンターテインメント</option>
        <option value="ミステリー">ミステリー</option>
        <option value="SF">SF</option>
        <option value="ホラー">ホラー</option>
        <option value="ファンタジー">ファンタジー</option>
        <option value="青春・恋愛">青春・恋愛</option>
        <option value="歴史・時代">歴史・時代</option>
        <option value="ノンフィクション">ノンフィクション</option>
        <option value="ビジネス・経済">ビジネス・経済</option>
        <option value="コンピュータ・IT">コンピュータ・IT</option>
        <option value="コミック">コミック</option>
        <option value="ライトノベル">ライトノベル</option>
        <option value="その他">その他</option>
      </select>
      {/* 並び替え */}
      <div className="d-flex flex-row p-0 mt-1 mt-sm-0">
        <label htmlFor="selectSort" className="text-right py-1 mr-1 mb-0">並び替え</label>
        <select onChange={sortChange} className="form-control-sm" id="selectSort">
          <option value="default">新着順</option>
          <option value="favorite">いいね数</option>
          <option value="ratings">評価順</option>
        </select>
      </div>
    </div>
  )
}

export default CategoryList
