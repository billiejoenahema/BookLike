import React from 'react';
import ReactDOM from 'react-dom';

function SearchItems() {
    return (
        <div className="col-12 p-0">
            <React.StrictMode>
                <form method="GET" action="{{ route('searchItems') }}" className="form-inline">
                    <input className="form-control col-8 ml-0"
                        name="keyword"
                        type="search"
                        placeholder="キーワードを入力"
                        aria-label="書籍を検索"
                        required autoComplete="on" />
                    <button className="btn btn-outline-success ml-2"
                        type="submit"
                        data-toggle="modal"
                        data-target="#searchItems">
                        <i className="fas fa-search"></i>
                    </button>
                </form>
            </React.StrictMode>
        </div>
    );
}

export default SearchItems;

if (document.getElementById('searchItems')) {
    ReactDOM.render(<SearchItems />, document.getElementById('searchItems'));
}
