@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">Testimonials Management</h1>
                <p class="text-gray-600 mt-1">Manage client testimonials and reviews</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Add New Testimonial
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 relative">
            {{ session('success') }}
            <button type="button" class="absolute top-0 right-0 p-3 text-green-400 hover:text-green-600" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Testimonials Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">All Testimonials ({{ $testimonials->total() }})</h3>
        </div>
        <div class="p-6">
            @if($testimonials->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profession</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                <th class="w-36 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($testimonials as $testimonial)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ $testimonial->image_url }}" 
                                             alt="{{ $testimonial->name }}" 
                                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-semibold text-gray-900">{{ $testimonial->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $testimonial->profession }}</td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs text-gray-700">
                                            {{ Str::limit($testimonial->desc, 80) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $testimonial->rating }}/5</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.testimonials.toggle-status', $testimonial) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="px-3 py-1 text-xs font-semibold rounded-full {{ $testimonial->status ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition duration-200"
                                                    title="Toggle Status">
                                                {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $testimonial->sort_order }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                               class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition duration-200" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                                  method="POST" 
                                                  class="inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition duration-200" title="Delete">
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
                <div class="flex justify-center mt-6">
                    {{ $testimonials->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-quote-left text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No testimonials found</h3>
                    <p class="text-gray-500 mb-6">Start by adding your first testimonial</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
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
