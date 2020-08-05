function deletePost(e) {
    "use strict";
    if (confirm("アカウントを削除しますか？")) {
        const delete_id = document.getElementById("delete_" + e.dataset.id);
        delete_id.submit();
    }
}
