@extends('layouts.admin')

@section('title', 'Manage FAQs - ' . $post->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></li>
                        <li class="breadcrumb-item active">FAQs</li>
                    </ol>
                </div>
                <h4 class="page-title">Manage FAQs for "{{ $post->title }}"</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h4 class="header-title">FAQ List</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.posts.faqs.create', $post->id) }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle me-1"></i> Add New FAQ
                            </a>
                        </div>
                    </div>

                    <form method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search FAQs..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $faq)
                                    <tr>
                                        <td>
                                            <strong>{{ Str::limit($faq->question, 50) }}</strong><br>
                                            <small class="text-muted">{{ Str::limit(strip_tags($faq->answer), 80) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $faq->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($faq->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $faq->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('admin.posts.faqs.edit', [$post->id, $faq->id]) }}" class="dropdown-item">
                                                        <i class="mdi mdi-pencil me-1"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.posts.faqs.destroy', [$post->id, $faq->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                                            <i class="mdi mdi-delete me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No FAQs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection