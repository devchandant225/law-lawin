@extends('layouts.admin')

@section('title', 'Media Manager')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Media Manager</h1>
        <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">
            <i class="fas fa-upload"></i>
            <span>Upload Media</span>
        </button>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
        <form action="{{ route('admin.media.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by file name..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <div class="w-full md:w-48">
                <select name="type" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Images</option>
                    <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDFs</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Filter</button>
            @if(request()->hasAny(['search', 'type']))
                <a href="{{ route('admin.media.index') }}" class="px-4 py-2 text-indigo-600 hover:text-indigo-800 flex items-center">Clear</a>
            @endif
        </form>
    </div>

    <!-- Media Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @forelse($media as $item)
            <div class="group relative bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <!-- Preview Container -->
                <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                    @if($item->isImage())
                        <img src="{{ $item->url }}" alt="{{ $item->original_name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @elseif($item->isPdf())
                        <div class="flex flex-col items-center">
                            <i class="fas fa-file-pdf text-red-500 text-5xl mb-2"></i>
                            <span class="text-xs font-medium text-gray-500 uppercase">PDF Document</span>
                        </div>
                    @else
                        <i class="fas fa-file text-gray-400 text-5xl"></i>
                    @endif
                </div>

                <!-- Overlay Actions -->
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                    <button onclick="copyToClipboard('{{ $item->url }}')" title="Copy URL" class="p-2 bg-white text-gray-700 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors">
                        <i class="fas fa-link"></i>
                    </button>
                    <a href="{{ $item->url }}" target="_blank" title="View Full" class="p-2 bg-white text-gray-700 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="p-2 bg-white text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>

                <!-- File Info -->
                <div class="p-3 border-t border-gray-100">
                    <p class="text-sm font-medium text-gray-900 truncate mb-1" title="{{ $item->original_name }}">
                        {{ $item->original_name }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $item->formatted_size }}</span>
                        <span>{{ $item->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-xl border-2 border-dashed border-gray-200">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-photo-video text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No media found</h3>
                <p class="text-gray-500">Upload your first image or PDF to get started.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $media->links() }}
    </div>
</div>

<!-- Upload Modal -->
<div id="upload-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('upload-modal').classList.add('hidden')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900" id="modal-title">Upload Media</h3>
                        <button type="button" onclick="document.getElementById('upload-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="mt-2">
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">Images (WebP, PNG, JPG, GIF) or PDFs (MAX. 10MB)</p>
                                </div>
                                <input type="file" name="files[]" class="hidden" multiple accept="image/*,application/pdf" onchange="updateFileCount(this)" />
                            </label>
                        </div>
                        <div id="file-count" class="mt-2 text-sm text-indigo-600 font-medium text-center hidden"></div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Start Upload
                    </button>
                    <button type="button" onclick="document.getElementById('upload-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateFileCount(input) {
    const fileCount = input.files.length;
    const display = document.getElementById('file-count');
    if (fileCount > 0) {
        display.textContent = `${fileCount} file(s) selected`;
        display.classList.remove('hidden');
    } else {
        display.classList.add('hidden');
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show success toast
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 bg-gray-900 text-white px-4 py-2 rounded-lg shadow-lg z-[100] transform transition-transform duration-300 translate-y-0';
        toast.innerHTML = '<div class="flex items-center gap-2"><i class="fas fa-check-circle text-green-400"></i> URL copied to clipboard!</div>';
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('translate-y-20');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }).catch(err => {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endpush
@endsection
