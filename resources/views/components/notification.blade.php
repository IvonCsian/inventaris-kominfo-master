@if (session('status'))
<div class="py-4">
    <div class="alert alert-success alert-dismissible fade show">
        <strong>Success!</strong> {{ session('status') }}
    </div>
</div>
@endif

@if (session('error'))
<div class="py-4">
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Error!</strong> {{ session('error') }}.
    </div>
</div>
@endif
