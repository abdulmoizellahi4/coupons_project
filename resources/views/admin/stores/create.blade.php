@extends('admin.layouts.app')

@section('title', 'Create New Store')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create New Store</h4>
            <a href="{{ route('stores.index') }}" class="btn btn-sm btn-secondary">⬅ Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('stores.store') }}" method="POST" enctype="multipart/form-data">
                @include('stores.form')
            </form>
        </div>
    </div>
</div>
@endsection
