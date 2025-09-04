@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Manage Coupons</h4>
            <div class="d-flex">
                <button id="bulk-delete-btn" class="btn btn-danger btn-sm mx-3" disabled>Delete Selected</button>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm">+ Add New Coupon</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class='alert alert-success'>{{ session('success') }}</div>
            @elseif(session('error'))
                <div class='alert alert-danger'>{{ session('error') }}</div>
            @endif

            <table id="couponsTable" class="table table-bordered table-striped align-middle w-100">
                <thead>
                    <tr>
                        <th width="30"><input type="checkbox" id="selectAll"></th>
                        <th width="30">☰</th>
                        <th>SL</th>
                        <th>Coupon Title</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Expiry</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                    <tr data-id="{{ $coupon->id }}">
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $coupon->id }}" class="rowCheckbox">
                        </td>
                        <td class="reorder-handle" style="cursor:move;">☰</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $coupon->coupon_title }}</td>
                        <td>{{ $coupon->brand_store }}</td>
                        <td>
                            <span class="badge {{ $coupon->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $coupon->status ? 'Enabled' : 'Disabled' }}
                            </span>
                        </td>
                        <td>{{ $coupon->date_expiry }}</td>
                        <td>
                            @if($coupon->cover_logo)
                                <img src="{{ asset('storage/'.$coupon->cover_logo) }}" width="50" alt="{{ $coupon->coupon_title }}">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            {{-- Single delete form --}}
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" 
                                  method="POST" 
                                  id="coupon-{{$coupon->id}}"
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
            tableSelector: '#couponsTable',
            bulkDeleteBtnSelector: '#bulk-delete-btn',
            selectAllSelector: '#selectAll',
            rowHandleSelector: 'td.reorder-handle',
            reorderUrl: '{{ route("admin.coupons.reorder") }}',
            bulkDeleteUrl: '{{ route("admin.coupons.bulkDelete") }}', // Bulk delete route
            csrfToken: '{{ csrf_token() }}'
        });
    });
</script>
@endsection
