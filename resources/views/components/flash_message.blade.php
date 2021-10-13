@if (session('flash_message'))
<div
    class="toast flash_message"
    id="flashMessage"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
>
    <div class="toast-header bg-success border-0">
        <strong class="mr-auto text-white">{{
            session("flash_message")
        }}</strong>
    </div>
</div>
@endif
