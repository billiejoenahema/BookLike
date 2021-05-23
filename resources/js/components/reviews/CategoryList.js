import React from 'react'

const CategoryList = ({ changeCategory, sortChange }) => {
  return (
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
  )
}

export default CategoryList
