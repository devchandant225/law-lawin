@extends('layouts.admin')

@section('title', 'Add New FAQ - ' . $post->title)

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.faqs.index', $post->id) }}">FAQs</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
                <h4 class="page-title">Add New FAQ for "{{ $post->title }}"</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">FAQ Information</h4>
                    
                    <form action="{{ route('admin.posts.faqs.store', $post->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                                    <textarea name="question" id="question" class="form-control @error('question') is-invalid @enderror" rows="3" placeholder="Enter the FAQ question">{{ old('question') }}</textarea>
                                    @error('question')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                                    <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid @enderror" rows="5" placeholder="Enter the FAQ answer">{{ old('answer') }}</textarea>
                                    @error('answer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <a href="{{ route('admin.posts.faqs.index', $post->id) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save FAQ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection