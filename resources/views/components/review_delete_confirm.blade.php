<!-- Review Delete Confirm Modal -->
<div class="modal fade" id="deleteReview" tabindex="-1" role="dialog" aria-labelledby="deleteReviewTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title font-weight-bold" id="delteReviewLongTitle">投稿を削除しますか？</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">キャンセル</button>
                <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-crimson rounded-pill">削除する</button>
                </form>
            </div>
        </div>
    </div>
