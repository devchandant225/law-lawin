{{-- User Profile Section --}}
<div class="flex items-center justify-between w-full">
    <div class="flex items-center gap-3 min-w-0 flex-1">
        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm shrink-0">
            <span class="text-sm font-semibold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
            <p class="text-xs text-white/70 truncate">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
        </div>
    </div>
    
    {{-- Logout Button --}}
    <form method="POST" action="{{ route('admin.logout') }}" class="inline shrink-0">
        @csrf
        <button type="submit" 
                class="p-2 text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition-colors duration-200 group"
                title="Logout">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"/>
            </svg>
        </button>
    </form>
</div>

{{-- Quick Stats (Optional - can be enabled later) --}}
{{--
<div class="mt-4 pt-4 border-t border-white/20">
    <div class="grid grid-cols-2 gap-2 text-center">
        <div class="bg-white/10 rounded-lg p-2">
            <div class="text-xs text-white/70">Online</div>
            <div class="text-sm font-semibold text-white">24/7</div>
        </div>
        <div class="bg-white/10 rounded-lg p-2">
            <div class="text-xs text-white/70">Version</div>
            <div class="text-sm font-semibold text-white">1.0</div>
        </div>
    </div>
</div>
--}}

{{-- User Menu Dropdown (Mobile Alternative) --}}
<script>
    // Add any user-specific JavaScript here if needed
    // For example, user preference handling, theme switching, etc.
</script>
