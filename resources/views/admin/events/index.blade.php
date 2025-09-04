@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Manage Events</h4>
            <div>
                <button id="bulk-delete-btn" class="btn btn-danger btn-sm mx-3" disabled>Delete Selected</button>
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">+ Add New Event</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table id="eventsTable" class="table table-bordered table-striped align-middle w-100">
                <thead>
                    <tr>
                        <th width="30"><input type="checkbox" id="selectAll"></th>
                        <th width="30">☰</th>
                        <th>SL</th>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date Available</th>
                        <th>Date Expiry</th>
                        <th>Front Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr data-id="{{ $event->id }}">
                            <td><input type="checkbox" value="{{ $event->id }}" class="rowCheckbox"></td>
                            <td class="reorder-handle" style="cursor:move;">☰</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ $event->event_type }}</td>
                            <td>{{ $event->status ? 'Enabled' : 'Disabled' }}</td>
                            <td>{{ $event->date_available }}</td>
                            <td>{{ $event->date_expiry }}</td>
                            <td>
                                @if($event->front_image)
                                    <img src="{{ asset('storage/'.$event->front_image) }}" width="50" alt="{{ $event->event_name }}">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline single-delete-form">
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
            <form id="bulkDeleteForm" action="{{ route('admin.events.bulkDelete') }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    initDataTableWithFeatures({
        tableSelector: '#eventsTable',
        bulkDeleteBtnSelector: '#bulk-delete-btn',
        selectAllSelector: '#selectAll',
        rowHandleSelector: 'td.reorder-handle',
        reorderUrl: '{{ route("admin.events.reorder") }}',
        csrfToken: '{{ csrf_token() }}',
        bulkDeleteUrl: '{{ route("admin.events.bulkDelete") }}' // Important for JS bulk delete
    });
});
</script>
@endsection
