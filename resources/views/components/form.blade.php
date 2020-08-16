<form method="GET" action="{{ route('searchItems') }}" class="form-inline">
@csrf
    <input class="form-control col-9 @error('keyword') is-invalid @enderror"
    name="keyword"
    type="search"
    placeholder="キーワードを入力"
    aria-label="書籍を検索"
    required autocomplete="on">
    @error('searchItems')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button class="btn btn-outline-success ml-2"
        type="submit"
        data-toggle="modal"
        data-target="#searchItems">
        <i class="fas fa-search"></i>
    </button>
</form>
