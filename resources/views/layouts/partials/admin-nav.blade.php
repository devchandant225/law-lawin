{{-- Dashboard --}}
<a href="{{ route('admin.dashboard') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
    </svg>
    <span class="hide-when-collapsed">Dashboard</span>
    @if (request()->routeIs('admin.dashboard'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Organization Profile --}}
<a href="{{ route('admin.profile.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.profile.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.profile.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
    </svg>
    <span class="hide-when-collapsed">Organization Profile</span>
    @if (request()->routeIs('admin.profile.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Posts Management --}}
<a href="{{ route('admin.posts.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.posts.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.posts.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M16,6V17H7V6H16M16.5,5H6.5A0.5,0.5 0 0,0 6,5.5V17.5A0.5,0.5 0 0,0 6.5,18H16.5A0.5,0.5 0 0,0 17,17.5V5.5A0.5,0.5 0 0,0 16.5,5Z" />
    </svg>
    <span class="hide-when-collapsed">Posts Management</span>
    @if (request()->routeIs('admin.posts.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Publications Management --}}
<a href="{{ route('admin.publications.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.publications.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.publications.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-2h4v-2h-4v2zm-2-2H7v2h5v-2zm2-2H7v2h7v-2zm0-2H7v2h7v-2zm2-2h4V7h-4v2z" />
    </svg>
    <span class="hide-when-collapsed">Publications</span>
    @if (request()->routeIs('admin.publications.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Teams Management --}}
<a href="{{ route('admin.teams.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.teams.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.teams.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
    </svg>
    <span class="hide-when-collapsed">Team Management</span>
    @if (request()->routeIs('admin.teams.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- FAQs Management --}}
<a href="{{ route('admin.faqs.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.faqs.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.faqs.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
    </svg>
    <span class="hide-when-collapsed">FAQs</span>
    @if (request()->routeIs('admin.faqs.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- About Us Content Management --}}
<a href="{{ route('admin.about-us-contents.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.about-us-contents.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.about-us-contents.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
    </svg>
    <span class="hide-when-collapsed">About Us Content</span>
    @if (request()->routeIs('admin.about-us-contents.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>



{{-- Sliders Management --}}
<a href="{{ route('admin.sliders.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.sliders.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.sliders.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-2h4v-2h-4v2zm-2-2H7v2h5v-2zm2-2H7v2h7v-2zm0-2H7v2h7v-2zm2-2h4V7h-4v2z" />
    </svg>
    <span class="hide-when-collapsed">Sliders</span>
    @if (request()->routeIs('admin.sliders.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>


{{-- Logout --}}
<a href="{{ route('admin.logout') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 text-red-700 hover:bg-red-50">
    <svg class="icon mr-3 h-5 w-5 text-red-500 group-hover:text-red-700" viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
    </svg>
    <span class="hide-when-collapsed">Logout</span>
</a>
