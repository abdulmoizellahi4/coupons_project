@extends('admin.layouts.app')
<style>
    table th, table td {
        font-size: 12px;
    }
</style>
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Manage Stores</h4>
            <div>
                <button id="bulk-delete-btn" class="btn btn-danger btn-sm mx-3" disabled>Delete Selected</button>
                <a href="{{ route('admin.stores.create') }}" class="btn btn-primary btn-sm">+ Add New Store</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table id="storesTable" class="table table-bordered table-striped align-middle w-100">
                <thead>
                    <tr>
                        <th width="30"><input type="checkbox" id="selectAll"></th>
                        <th width="30">☰</th>
                        <th>SL</th>
                        <th>Store Name</th>
                        <th>Category</th>
                        <th>Event</th>
                        <th>Current Network</th>
                        <th>Available Network</th>
                        <th>Store Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stores as $store)
                        <tr data-id="{{ $store->id }}">
                            <td><input type="checkbox" value="{{ $store->id }}" class="rowCheckbox"></td>
                            <td class="reorder-handle" style="cursor:move;">☰</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $store->store_name }}<br>{{ $store->affiliate_url }}</td>
                            <td>
    @if($store->categories->count())
        {{ $store->categories->pluck('category_name')->join(', ') }}
    @else
        -
    @endif
</td>

<td>
    @if($store->events->count())
        {{ $store->events->pluck('event_name')->join(', ') }}
    @else
        -
    @endif
</td>

                            <td>{{ $store->currentNetwork->name ?? '-' }}</td>
                            <td>{{ $store->availableNetwork->name ?? '-' }}</td>
                            <td>
                                @if($store->store_logo)
                                    <img src="{{ asset('storage/'.$store->store_logo) }}" width="50" alt="{{ $store->store_name }}">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" class="d-inline single-delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Hidden form for bulk delete --}}
            <form id="bulkDeleteForm" action="{{ route('admin.stores.bulkDelete') }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    initDataTableWithFeatures({
        tableSelector: '#storesTable',
        bulkDeleteBtnSelector: '#bulk-delete-btn',
        selectAllSelector: '#selectAll',
        rowHandleSelector: 'td.reorder-handle',
        reorderUrl: '{{ route("admin.stores.reorder") }}',
        bulkDeleteUrl: '{{ route("admin.stores.bulkDelete") }}',
        csrfToken: '{{ csrf_token() }}'
    });
});
</script>
@endsection
