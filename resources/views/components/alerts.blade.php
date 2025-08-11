{{-- x-alerts --}}
@if (session('success'))
    <div class="alert alert-success alert-enhanced">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-enhanced">{{ session('error') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-enhanced">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<style>
    .alert-enhanced {
        font-size: 1.2rem;
        padding: 1.25rem 1.5rem;
    }

    .alert-enhanced ul {
        padding-left: 1.5rem;
        margin-bottom: 0;
    }

    .alert-enhanced li {
        margin-bottom: 0.5rem;
    }
</style>
