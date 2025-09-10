@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Total Coupons</p>
                        <div class="d-flex align-items-center mb-1">
                            <h4 class="mb-0 me-1">{{ \App\Models\Coupon::count() }}</h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="ri-coupon-line ri-24px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Total Stores</p>
                        <div class="d-flex align-items-center mb-1">
                            <h4 class="mb-0 me-1">{{ \App\Models\Store::count() }}</h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded p-2">
                            <i class="ri-store-line ri-24px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Total Categories</p>
                        <div class="d-flex align-items-center mb-1">
                            <h4 class="mb-0 me-1">{{ \App\Models\Category::count() }}</h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-info rounded p-2">
                            <i class="ri-folder-line ri-24px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Active Events</p>
                        <div class="d-flex align-items-center mb-1">
                            <h4 class="mb-0 me-1">{{ \App\Models\Events::where('status', 1)->count() }}</h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="ri-calendar-event-line ri-24px"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Coupons -->
    <div class="col-lg-8 col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Coupons</h5>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Store</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Coupon::with('store')->latest()->take(5)->get() as $coupon)
                            <tr>
                                <td>{{ $coupon->coupon_title }}</td>
                                <td>{{ $coupon->brand_store }}</td>
                                <td>
                                    @if($coupon->coupon_code)
                                        <span class="badge bg-label-info">{{ $coupon->coupon_code }}</span>
                                    @else
                                        <span class="text-muted">No Code</span>
                                    @endif
                                </td>
                                <td>
                                    @if($coupon->status)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $coupon->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No coupons found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                        <i class="ri-add-line me-1"></i> Add New Coupon
                    </a>
                    <a href="{{ route('admin.stores.create') }}" class="btn btn-success">
                        <i class="ri-store-line me-1"></i> Add New Store
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-info">
                        <i class="ri-folder-add-line me-1"></i> Add New Category
                    </a>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-warning">
                        <i class="ri-calendar-event-line me-1"></i> Add New Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Top Stores -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Top Stores</h5>
                <a href="{{ route('admin.stores.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Store Name</th>
                                <th>Coupons Count</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Store::withCount('coupons')->latest()->take(10)->get() as $store)
                            <tr>
                                <td>{{ $store->store_name }}</td>
                                <td>
                                    <span class="badge bg-label-primary">{{ $store->coupons_count }}</span>
                                </td>
                                <td>
                                    @if($store->status)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($store->featured)
                                        <span class="badge bg-label-warning">Featured</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $store->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No stores found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
