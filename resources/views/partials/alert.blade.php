{{-- File: resources/views/partials/alert.blade.php --}}
@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

@if (session('warning'))
    <div class="alert-warning">{{ session('warning') }}</div>
@endif

@if (session('info'))
    <div class="alert-info">{{ session('info') }}</div>
@endif