@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Manage Categories</h4>
            <div class="d-flex">
                <button id="bulk-delete-btn" class="btn btn-danger btn-sm mx-3" disabled>Delete Selected</button>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">+ Add New Category</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class='alert alert-success'>{{ session('success') }}</div>
            @elseif(session('error'))
                <div class='alert alert-danger'>{{ session('error') }}</div>
            @endif

            {{-- No outer bulk form anymore --}}
            <table id="categoriesTable" class="table table-bordered table-striped align-middle w-100">
                <thead>
                    <tr>
                        <th width="30"><input type="checkbox" id="selectAll"></th>
                        <th width="30">☰</th>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Status</th>
                <th>Featured</th>
                <th>Show Home</th>
                <th>Recommended</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr data-id="{{ $category->id }}">
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $category->id }}" class="rowCheckbox">
                        </td>
                        <td class="reorder-handle" style="cursor:move;">☰</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <span class="badge {{ $category->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $category->status ? 'Enabled' : 'Disabled' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $category->featured ? 'bg-warning' : 'bg-secondary' }}">
                                {{ $category->featured ? 'Featured' : 'No' }}
                            </span>
                        </td>
                <td>
                    <span class="badge {{ $category->show_home ? 'bg-info' : 'bg-secondary' }}">
                        {{ $category->show_home ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td>
                    <span class="badge {{ $category->recommended ? 'bg-success' : 'bg-secondary' }}">
                        {{ $category->recommended ? 'Yes' : 'No' }}
                    </span>
                </td>
                        <td>
                            @if($category->media)
                                <img src="{{ asset('storage/'.$category->media) }}" width="50" alt="{{ $category->category_name }}">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            {{-- Single delete form --}}
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                  method="POST" 
                                  id="category-{{$category->id}}"
                                  class="d-inline single-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- JS init --}}
<script>
    $(document).ready(function () {
        initDataTableWithFeatures({
            tableSelector: '#categoriesTable',
            bulkDeleteBtnSelector: '#bulk-delete-btn',
            selectAllSelector: '#selectAll',
            rowHandleSelector: 'td.reorder-handle',
            reorderUrl: '{{ route("admin.categories.reorder") }}',
            bulkDeleteUrl: '{{ route("admin.categories.bulk-delete") }}', // pass route here
            csrfToken: '{{ csrf_token() }}'
        });
    });
</script>

@endsection
