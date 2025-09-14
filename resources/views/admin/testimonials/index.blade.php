@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Testimonials Management</h1>
                    <p class="text-muted">Manage client testimonials and reviews</p>
                </div>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Add New Testimonial
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Testimonials Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Testimonials ({{ $testimonials->total() }})</h6>
        </div>
        <div class="card-body">
            @if($testimonials->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th width="80">Image</th>
                                <th>Name</th>
                                <th>Profession</th>
                                <th>Description</th>
                                <th width="100">Rating</th>
                                <th width="80">Status</th>
                                <th width="80">Order</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td>
                                        <img src="{{ $testimonial->image_url }}" 
                                             alt="{{ $testimonial->name }}" 
                                             class="img-thumbnail"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $testimonial->name }}</strong>
                                    </td>
                                    <td>{{ $testimonial->profession }}</td>
                                    <td>
                                        <div style="max-width: 200px;">
                                            {{ Str::limit($testimonial->desc, 80) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                        <small class="text-muted">{{ $testimonial->rating }}/5</small>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.testimonials.toggle-status', $testimonial) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-sm {{ $testimonial->status ? 'btn-success' : 'btn-secondary' }}"
                                                    title="Toggle Status">
                                                {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $testimonial->sort_order }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $testimonials->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-quote-left fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No testimonials found</h5>
                    <p class="text-muted">Start by adding your first testimonial</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                        Add New Testimonial
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
