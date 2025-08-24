@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mt-6 mb-4">Sliders</h1>
    <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary">Dashboard</a></li>
            <li class="flex items-center">
                <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-500">Sliders</span>
            </li>
    </ol>
    </nav>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded-r-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Sliders List
            </h2>
            <a href="{{ route('admin.sliders.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Slider
            </a>
        </div>
        
        <div class="p-6">
            @if($sliders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @php 
                                    $headers = [
                                        'ID' => 'w-12 text-left', 
                                        'Image' => 'w-24 text-left', 
                                        'Title' => 'text-left', 
                                        'Description' => 'text-left', 
                                        'Order' => 'w-20 text-center', 
                                        'Status' => 'w-32 text-center', 
                                        'Created At' => 'w-32 text-left', 
                                        'Actions' => 'w-32 text-center'
                                    ];
                                @endphp
                                @foreach($headers as $header => $classes)
                                    <th scope="col" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider {{ $classes }}">
                                        {{ $header }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($sliders as $slider)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $slider->id }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if($slider->image)
                                            <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" 
                                                 class="h-16 w-24 object-cover rounded-md shadow-sm">
                                        @else
                                            <span class="text-gray-500 text-sm">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $slider->title }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-600">
                                                {{ Str::limit($slider->description, 50) }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $slider->orderlist }}
                                            </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <button class="toggle-status inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium 
                                            {{ $slider->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}"
                                                data-slider-id="{{ $slider->id }}" 
                                                data-current-status="{{ $slider->status }}">
                                            {{ $slider->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $slider->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.sliders.show', $slider) }}" 
                                               class="text-blue-600 hover:text-blue-900 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.sliders.edit', $slider) }}" 
                                               class="text-yellow-600 hover:text-yellow-900 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.sliders.destroy', $slider) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this slider?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h5 class="mt-4 text-xl font-semibold text-gray-600">No sliders found</h5>
                    <p class="mt-2 text-sm text-gray-500">Create your first slider to get started.</p>
                    <a href="{{ route('admin.sliders.create') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-600 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Slider
                    </a>
                </div>
            @endif
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
