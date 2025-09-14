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

{{-- Contact Submissions Management --}}
<a href="{{ route('admin.contacts.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.contacts.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.contacts.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4M20,18H4V8L12,13L20,8V18M20,6L12,11L4,6H20Z" />
    </svg>
    <span class="hide-when-collapsed">Contact Submissions</span>
    @if (request()->routeIs('admin.contacts.*'))
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

{{-- Portfolio Management --}}
<a href="{{ route('admin.portfolios.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.portfolios.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.portfolios.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z" />
    </svg>
    <span class="hide-when-collapsed">Portfolio</span>
    @if (request()->routeIs('admin.portfolios.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Pages Management --}}
<a href="{{ route('admin.pages.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.pages.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.pages.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M16,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V8L16,3M18,19H6V5H15V9H18V19Z" />
    </svg>
    <span class="hide-when-collapsed">Pages</span>
    @if (request()->routeIs('admin.pages.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Meta Tags Management --}}
<a href="{{ route('admin.meta-tags.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.meta-tags.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.meta-tags.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M5.5,7A1.5,1.5 0 0,1 4,5.5A1.5,1.5 0 0,1 5.5,4A1.5,1.5 0 0,1 7,5.5A1.5,1.5 0 0,1 5.5,7M21.41,11.58L12.41,2.58C12.05,2.22 11.55,2 11,2H4C2.89,2 2,2.89 2,4V11C2,11.55 2.22,12.05 2.59,12.41L11.58,21.41C11.95,21.78 12.45,22 13,22C13.55,22 14.05,21.78 14.41,21.41L21.41,14.41C21.78,14.05 22,13.55 22,13C22,12.45 21.78,11.95 21.41,11.58Z" />
    </svg>
    <span class="hide-when-collapsed">Meta Tags</span>
    @if (request()->routeIs('admin.meta-tags.*'))
        <div class="ml-auto hide-when-collapsed">
            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
        </div>
    @endif
</a>

{{-- Testimonials Management --}}
<a href="{{ route('admin.testimonials.index') }}"
    class="nav-item group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'text-gray-900 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
    <svg class="icon mr-3 h-5 w-5 {{ request()->routeIs('admin.testimonials.*') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"
        viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5M12.5,18.5C12.5,17.67 13.17,17 14,17C14.83,17 15.5,17.67 15.5,18.5C15.5,19.33 14.83,20 14,20C13.17,20 12.5,19.33 12.5,18.5M17.5,18.5C17.5,17.67 18.17,17 19,17C19.83,17 20.5,17.67 20.5,18.5C20.5,19.33 19.83,20 19,20C18.17,20 17.5,19.33 17.5,18.5M21,16V18H23V20H21V22H19V20H17V18H19V16H21Z" />
    </svg>
    <span class="hide-when-collapsed">Testimonials</span>
    @if (request()->routeIs('admin.testimonials.*'))
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
