import React from 'react';

const ModalSearchForm = ({ selectCriteria, modalSearchSubmit }) => {
  return (
    <>
      {/* スマホ用検索ボタン */}
      <div
        type="button"
        id="modalSearchButton"
        className="search-modal-button search-modal"
        data-toggle="modal"
        data-target="#searchModal"
      >
        <i className="fas fa-search text-teal"></i>
      </div>

      <div
        className="modal fade search-modal"
        id="searchModal"
        tabIndex="-1"
        role="dialog"
        aria-labelledby="searchModalLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog" role="document">
          <div className="modal-content">
            <div className="modal-body p-1">
              <div className="d-flex flex-row">
                <select
                  onChange={selectCriteria}
                  className="text-right bg-transparent border-0 mr-1"
                >
                  <option value="title">タイトル</option>
                  <option value="author">著者</option>
                  <option value="manufacturer">出版社</option>
                </select>
                <form onSubmit={modalSearchSubmit}>
                  <input
                    className="form-control rounded-pill pr-0"
                    id="modalSearchBooks"
                    type="search"
                    name="search"
                    placeholder="タイトルで検索..."
                    aria-label="書籍検索"
                    autoComplete="off"
                  />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default ModalSearchForm;
