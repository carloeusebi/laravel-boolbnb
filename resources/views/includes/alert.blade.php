@if (session('message'))
    <div class="alert alert-{{ session('type') ?? 'info' }} alert-dismissible fade show mt-4" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
