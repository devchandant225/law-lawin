@extends('layouts.admin')

@section('title', 'View Slider')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mt-6 mb-4">View Slider</h1>
    <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary">Dashboard</a></li>
            <li class="flex items-center">
                <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('admin.sliders.index') }}" class="hover:text-primary">Sliders</a>
            </li>
            <li class="flex items-center">
                <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-500">View</span>
            </li>
        </ol>
    </nav>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Slider Details
                </h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="inline-flex items-center px-3 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this slider?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Slider Image</h3>
                            @if($slider->image)
                                <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" 
                                     class="w-full rounded-lg shadow-md object-cover max-h-96">
                            @else
                                <div class="bg-gray-100 rounded-lg p-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">No image available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Title</h3>
                            <p class="text-xl font-bold text-gray-900">{{ $slider->title }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                            @if($slider->description)
                                <p class="text-gray-600">{{ $slider->description }}</p>
                            @else
                                <p class="text-gray-500 italic">No description provided</p>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 mb-2">Order</h3>
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                    {{ $slider->orderlist }}
                                </span>
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-600 mb-2">Status</h3>
                                <button class="toggle-status inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $slider->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}"
                                        data-slider-id="{{ $slider->id }}" 
                                        data-current-status="{{ $slider->status }}">
                                    {{ $slider->status ? 'Active' : 'Inactive' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 grid md:grid-cols-2 gap-4 border-t pt-6 border-gray-200">
                    <div>
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Created At</h3>
                        <p class="text-gray-900 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $slider->created_at->format('F d, Y \a\t g:i A') }}
                        </p>
                        <small class="text-gray-500">{{ $slider->created_at->diffForHumans() }}</small>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Last Updated</h3>
                        <p class="text-gray-900 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $slider->updated_at->format('F d, Y \a\t g:i A') }}
                        </p>
                        <small class="text-gray-500">{{ $slider->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                <a href="{{ route('admin.sliders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.toggle-status').click(function() {
        const sliderId = $(this).data('slider-id');
        const currentStatus = $(this).data('current-status');
        const button = $(this);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: `/admin/sliders/${sliderId}/toggle-status`,
            type: 'POST',
            success: function(response) {
                if (response.success) {
                    // Update button appearance
                    if (response.status) {
                        button.removeClass('bg-red-100 text-red-800').addClass('bg-green-100 text-green-800');
                        button.text('Active');
                        button.data('current-status', true);
                    } else {
                        button.removeClass('bg-green-100 text-green-800').addClass('bg-red-100 text-red-800');
                        button.text('Inactive');
                        button.data('current-status', false);
                    }
                    
                    // Show success message
                    const alertHtml = `
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded-r-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">${response.message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('.container').prepend(alertHtml);
                    
                    // Auto hide alert after 3 seconds
                    setTimeout(function() {
                        $('.bg-green-50').fadeOut(500, function() { $(this).remove(); });
                    }, 3000);
                }
            },
            error: function() {
                alert('Error updating slider status. Please try again.');
            }
        });
    });
});
</script>
@endsection
