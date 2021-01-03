<div class="modal fade" id="deleteComfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteComfirmModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">本当にアカウントを削除しますか？</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>「削除する」ボタンを押すとあなたのアカウント情報はすべて消去されます</span>
                <div class="form-group form-check mt-3 ml-2">
                    @if($login_user->id == 1)
                    <input type="checkbox" class="form-check-input" disabled>
                    <label class="form-check-label text-muted" for="deleteCheck">アカウントを完全に削除する</label>
                    <br />
                    <span class="text-danger">ゲストユーザーはアカウントを削除できません</span>
                    @else
                    <input type="checkbox" class="form-check-input" id="deleteCheck" onchange="deleteCheck()">
                    <label class="form-check-label" for="deleteCheck">アカウントを完全に削除する</label>
                    @endif
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary rounded-pill mr-3" data-dismiss="modal">キャンセル</button>
                <form method="POST" action="{{ route('users.destroy', $login_user->id) }}"
                    id="delete_{{ $login_user->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="deleteButton" class="btn btn-crimson rounded-pill disabled"
                        disabled>削除する</button>
                </form>
            </div>
        </div>
    </div>
</div>
