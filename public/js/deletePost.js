export default function deletePost(e) {
    'use strict'
    if (confirm('削除してもよろしいですか？')) {
        const delete_id = document.getElementById('delete_' + e.dataset.id)
        delete_id.submit()
    }
}
