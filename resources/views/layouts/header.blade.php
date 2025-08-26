{{-- Top Contact Bar --}}
<div class="bg-primary text-white hidden md:block border-b border-white/10">
	<div class="max-w-7xl mx-auto px-4">
		<div class="flex items-center justify-between text-sm">
			<div class="flex items-center gap-6">
				@if($globalProfile && $globalProfile->phone1)
				<a href="tel:{{ preg_replace('/[^0-9+]/', '', $globalProfile->phone1) }}" class="flex items-center gap-2 hover:text-yellow-200 transition-colors group">
					<svg class="w-4 h-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
						<path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/>
					</svg>
					{{ $globalProfile->phone1 }}
				</a>
				@endif
				@if($globalProfile && $globalProfile->email)
				<a href="mailto:{{ $globalProfile->email }}" class="flex items-center gap-2 hover:text-yellow-200 transition-colors group">
					<svg class="w-4 h-4 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
						<path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
					</svg>
					{{ $globalProfile->email }}
				</a>
				@endif
			</div>
			<div class="flex items-center gap-1">
				@if($globalProfile && $globalProfile->facebook_link)
				<a href="{{ $globalProfile->facebook_link }}" target="_blank" rel="noopener" aria-label="Facebook" class="p-1.5 rounded-full hover:bg-white/20 transition-all hover:scale-110">
					<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.48 17.52 2 11.94 2S2 6.48 2 12.06c0 5.02 3.66 9.19 8.44 9.94v-7.03H7.9v-2.91h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.55v1.86h2.76l-.44 2.91h-2.32v7.03C18.34 21.25 22 17.08 22 12.06z"/></svg>
				</a>
				@endif
				@if($globalProfile && $globalProfile->linkedin_link)
				<a href="{{ $globalProfile->linkedin_link }}" target="_blank" rel="noopener" aria-label="LinkedIn" class="p-1.5 rounded-full hover:bg-white/20 transition-all hover:scale-110">
					<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.47,2H3.53A1.45,1.45 0 0,0 2.06,3.43V20.57A1.45,1.45 0 0,0 3.53,22H20.47A1.45,1.45 0 0,0 21.94,20.57V3.43A1.45,1.45 0 0,0 20.47,2M8.09,18.74H5.09V9.69H8.09M6.59,8.48C5.61,8.48 4.82,7.69 4.82,6.71C4.82,5.73 5.61,4.94 6.59,4.94C7.57,4.94 8.36,5.73 8.36,6.71C8.36,7.69 7.57,8.48 6.59,8.48M18.91,18.74H15.91V14.37C15.91,13.22 15.91,11.71 14.29,11.71C12.65,11.71 12.42,12.95 12.42,14.29V18.74H9.42V9.69H12.3V11.09H12.34C12.73,10.38 13.71,9.63 15.18,9.63C18.22,9.63 18.91,11.69 18.91,14.37V18.74Z"/></svg>
				</a>
				@endif
				@if($globalProfile && $globalProfile->whatsapp)
				<a href="https://wa.me/{{ preg_replace('/[^0-9+]/', '', $globalProfile->whatsapp) }}" target="_blank" rel="noopener" aria-label="WhatsApp" class="p-1.5 rounded-full hover:bg-white/20 transition-all hover:scale-110">
					<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.488"/></svg>
				</a>
				@endif
				@if($globalProfile && $globalProfile->viber)
				<a href="viber://chat?number={{ preg_replace('/[^0-9+]/', '', $globalProfile->viber) }}" target="_blank" rel="noopener" aria-label="Viber" class="p-1.5 rounded-full hover:bg-white/20 transition-all hover:scale-110">
					<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M11.398.002C9.473.028 5.331.344 3.014 2.467 1.294 4.177.693 6.698.623 9.82c-.06 3.11-.13 8.95 5.5 10.541v2.42s-.038.97.602.582c.64-.388 2.072-1.78 2.072-1.78 0 0 .53.043 1.103.043 4.65 0 8.395-.935 8.99-7.645.615-6.876-1.308-11.166-7.492-11.98-.41-.053-.821-.073-1.228-.074zm.067 1.697c.313.006.626.02.935.048 5.004.463 6.45 3.86 5.966 9.27-.47 5.276-3.095 5.972-6.95 5.972-.43 0-.86-.03-1.285-.09 0 0-2.295 1.515-3.014 2.05.02-.79.13-2.82.13-2.82-4.09-1.05-4.06-5.11-4.06-8.14.06-2.45.51-4.38 1.79-5.664 1.67-1.684 4.45-1.964 6.487-1.626zM9.8 6.116c-.833.037-1.378.32-1.378 1.024 0 .83 1.097 1.7 2.45 2.24.72.29 1.44.44 2.15.44 2.26 0 4.09-1.4 4.09-3.13 0-.72-.48-1.35-1.26-1.59-.72-.22-1.52-.31-2.38-.31-1.32 0-2.64.17-3.67.33zm2.45.49c.78 0 1.5.1 2.13.27.4.11.65.37.65.68 0 .97-1.08 1.76-2.42 1.76-.5 0-.99-.1-1.46-.29-.93-.37-1.72-.9-1.72-1.46 0-.39.24-.66.69-.71.71-.1 1.48-.25 2.14-.25z"/></svg>
				</a>
				@endif
				@if($globalProfile && $globalProfile->wechat_link)
				<a href="{{ $globalProfile->wechat_link }}" target="_blank" rel="noopener" aria-label="WeChat" class="p-1.5 rounded-full hover:bg-white/20 transition-all hover:scale-110">
					<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8.691 2.188C3.891 2.188 0 5.476 0 9.53c0 2.212 1.14 4.203 2.906 5.498L2.438 17.75l3.719-1.906c.75.188 1.547.281 2.375.281.188 0 .375 0 .563-.031-.125-.375-.203-.781-.203-1.219 0-3.656 3.094-6.625 6.906-6.625.406 0 .813.031 1.203.094C16.594 4.578 13.063 2.188 8.691 2.188zm-2.375 2.406c.688 0 1.25.563 1.25 1.25s-.563 1.25-1.25 1.25-1.25-.563-1.25-1.25.563-1.25 1.25-1.25zm4.75 0c.688 0 1.25.563 1.25 1.25s-.563 1.25-1.25 1.25-1.25-.563-1.25-1.25.563-1.25 1.25-1.25zM15.312 9.375c-3.375 0-6.125 2.313-6.125 5.156 0 .781.25 1.5.656 2.156l-.5 2.344 2.469-1.281c.594.125 1.188.219 1.844.219 3.375 0 6.125-2.313 6.125-5.156s-2.75-5.438-6.125-5.438zm-1.969 1.594c.563 0 1.031.469 1.031 1.031s-.469 1.031-1.031 1.031-1.031-.469-1.031-1.031.469-1.031 1.031-1.031zm3.875 0c.563 0 1.031.469 1.031 1.031s-.469 1.031-1.031 1.031-1.031-.469-1.031-1.031.469-1.031 1.031-1.031z"/></svg>
				</a>
				@endif
			</div>
		</div>
	</div>
</div>
{{-- Main Navigation Header --}}
<header class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b py-3 border-primary/20 transition-all duration-300">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex items-center justify-between h-16">
			{{-- Logo Section --}}
			<a href="{{ url('/') }}" class="flex items-center gap-3 group transition-transform hover:scale-105">
				<div class="relative">
					@if($globalProfile && $globalProfile->logo)
					<div class="w-[10rem] h-[4rem] rounded-xl flex items-center justify-center group-hover:shadow-purple-600/25 transition-all">
						<img src="{{ asset('storage/' . $globalProfile->logo) }}" alt="{{ $globalProfile->name ?? 'Organization Logo' }}" class="h-full w-full object-cover scale-110">
					</div>
					@else
					<div class="h-10 w-10 bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-purple-600/25 transition-all">
						<svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
							<path d="M16,6V17H7V6H16M16.5,5H6.5A0.5,0.5 0 0,0 6,5.5V17.5A0.5,0.5 0 0,0 6.5,18H16.5A0.5,0.5 0 0,0 17,17.5V5.5A0.5,0.5 0 0,0 16.5,5Z"/>
							<path d="M18,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V4A2,2 0 0,0 18,2M18,20H6V4H18V20Z"/>
						</svg>
					</div>
					@endif
				</div>

				<div class="sm:hidden">
					<div class="text-base font-bold text-gray-900 group-hover:text-purple-700 transition-colors">
						{{ Str::limit($globalProfile->name ?? 'Lawin', 10) }}
					</div>
				</div>
			</a>

			{{-- Mobile Menu Button --}}
			<button id="mobile-menu-button" class="md:hidden relative inline-flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/20 text-gray-700 hover:from-primary/20 hover:to-secondary/20 transition-all duration-200 hover:scale-105" aria-controls="mobile-menu" aria-expanded="false">
				<svg class="h-5 w-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
				<span class="sr-only">Open main menu</span>
			</button>

			<nav class="hidden md:flex items-center gap-6">
				<a href="{{ url('/') }}" class="hover:text-purple-700 font-medium">Home</a>

				<div class="relative group">
					<button class="inline-flex items-center gap-1 hover:text-purple-700 font-medium">
						<span>About Us</span>
						<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
					</button>
					<div class="absolute left-0 mt-2 hidden group-hover:block w-56 rounded-md border bg-white shadow-lg p-2">
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/about/history') }}">Our History</a>
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/about/team') }}">Our Team</a>
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/about/values') }}">Our Values</a>
					</div>
				</div>

				
				<div class="relative group">
					<button class="inline-flex items-center gap-1 hover:text-purple-700 font-medium">
						<span>Practice Area</span>
						<svg class="h-4 w-4 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
					</button>
					<div class="absolute left-0 mt-2 hidden group-hover:block w-80 rounded-xl border border-gray-200 bg-white shadow-2xl overflow-hidden">
						<div class="bg-gradient-to-r from-green-50 to-blue-50 px-4 py-3 border-b border-gray-100">
							<div class="flex items-center justify-between">
								<h3 class="font-semibold text-gray-900">Legal Practices</h3>
								<a href="{{ route('practices.index') }}" class="text-xs text-green-600 hover:text-green-700 font-medium">View All →</a>
							</div>
						</div>
						<div class="max-h-96 overflow-y-auto">
							<div class="p-2">
								@if(isset($navPracticeAreas) && $navPracticeAreas->count() > 0)
									@foreach($navPracticeAreas->take(8) as $practice)
									 <a class="block px-3 py-2.5 rounded-lg hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-200 group/item" 
									   href="{{ route('practice.show', $practice->slug) }}">
										<div class="flex items-start gap-3">
											<div class="mt-1 flex-shrink-0">
												<div class="w-8 h-8 bg-gradient-to-br from-green-100 to-blue-100 rounded-lg flex items-center justify-center group-hover/item:from-green-200 group-hover/item:to-blue-200 transition-colors">
													<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
													</svg>
												</div>
											</div>
											<div class="flex-1">
												<div class="font-medium text-gray-900 group-hover/item:text-green-700 transition-colors">
													{{ $practice->title }}
												</div>
												@if($practice->excerpt)
												<div class="text-xs text-gray-500 mt-0.5 line-clamp-1">
													{{ Str::limit($practice->excerpt, 50) }}
												</div>
												@endif
											</div>
											<svg class="w-4 h-4 text-gray-400 group-hover/item:text-green-600 transition-all transform group-hover/item:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
											</svg>
										</div>
									</a>
									@endforeach
									
									@if($navPublications->count() > 8)
									<div class="border-t border-gray-100 mt-2 pt-2">
										<a href="{{ route('practices.index') }}"
										   class="block px-3 py-2 text-center text-sm font-medium text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors">
											View All {{ $navPublications->count() }} Practices →
										</a>
									</div>
									@endif
								@else
									<div class="px-4 py-8 text-center">
										<svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
										</svg>
										<p class="text-gray-500 text-sm">No practices available</p>
										<a href="{{ route('practices.index') }}" class="text-green-600 text-sm hover:text-green-700 mt-2 inline-block font-medium">
											Browse Practices →
										</a>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>

				<div class="relative group">
					<button class="inline-flex items-center gap-1 hover:text-purple-700 font-medium">
						<span>Our Services</span>
						<svg class="h-4 w-4 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
					</button>
					<div class="absolute left-0 mt-2 hidden group-hover:block w-80 rounded-xl border border-gray-200 bg-white shadow-2xl overflow-hidden">
						<div class="bg-gradient-to-r from-purple-50 to-blue-50 px-4 py-3 border-b border-gray-100">
							<div class="flex items-center justify-between">
								<h3 class="font-semibold text-gray-900">Professional Services</h3>
								<a href="{{ route('services.index') }}" class="text-xs text-purple-600 hover:text-purple-700 font-medium">View All →</a>
							</div>
						</div>
						<div class="max-h-96 overflow-y-auto">
							<div class="p-2">
								@if(isset($navServices) && $navServices->count() > 0)
									@foreach($navServices->take(8) as $service)
									 <a class="block px-3 py-2.5 rounded-lg hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50 transition-all duration-200 group/item" 
									   href="{{ route('service.show', $service->slug) }}">
										<div class="flex items-start gap-3">
											<div class="mt-1 flex-shrink-0">
												<div class="w-8 h-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg flex items-center justify-center group-hover/item:from-purple-200 group-hover/item:to-blue-200 transition-colors">
													<svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
													</svg>
												</div>
											</div>
											<div class="flex-1">
												<div class="font-medium text-gray-900 group-hover/item:text-purple-700 transition-colors">
													{{ $service->title }}
												</div>
												@if($service->excerpt)
												<div class="text-xs text-gray-500 mt-0.5 line-clamp-1">
													{{ Str::limit($service->excerpt, 50) }}
												</div>
												@endif
											</div>
											<svg class="w-4 h-4 text-gray-400 group-hover/item:text-purple-600 transition-all transform group-hover/item:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
											</svg>
										</div>
									</a>
									@endforeach
									
									@if($navServices->count() > 8)
									<div class="border-t border-gray-100 mt-2 pt-2">
										<a href="{{ route('services.index') }}" 
										   class="block px-3 py-2 text-center text-sm font-medium text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-lg transition-colors">
											View All {{ $navServices->count() }} Services →
										</a>
									</div>
									@endif
								@else
									<div class="px-4 py-8 text-center">
										<svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
										</svg>
										<p class="text-gray-500 text-sm">No services available</p>
										<a href="{{ route('services.index') }}" class="text-purple-600 text-sm hover:text-purple-700 mt-2 inline-block font-medium">
											Browse Services →
										</a>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>


				<div class="relative group">
					<button class="inline-flex items-center gap-1 hover:text-purple-700 font-medium">
						<span>News</span>
						<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
					</button>
					<div class="absolute left-0 mt-2 hidden group-hover:block w-56 rounded-md border bg-white shadow-lg p-2">
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/news') }}">Latest News</a>
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/articles') }}">Legal Articles</a>
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/newsletters') }}">Newsletters</a>
						<a class="block px-3 py-2 rounded hover:bg-gray-50" href="{{ url('/resources') }}">Resources</a>
					</div>
				</div>

				<a href="{{ url('/team') }}" class="hover:text-purple-700 font-medium">Our Team</a>
				<a href="{{ url('/contact') }}" class="hover:text-purple-700 font-medium">Contact Us</a>
				
			</nav>
		</div>
	</div>

	<div id="mobile-menu" class="md:hidden hidden border-t bg-white">
		<div class="px-4 py-4 space-y-1">
			<a class="block px-2 py-2 rounded hover:bg-gray-50 font-medium" href="{{ url('/') }}">Home</a>
			<div>
				<div class="px-2 py-1 text-xs uppercase text-gray-500">About Us</div>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/about/history') }}">Our History</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/about/team') }}">Our Team</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/about/values') }}">Our Values</a>
			</div>
			<div>
				<div class="px-2 py-1 text-xs uppercase text-gray-500">Practice Areas</div>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/practice/corporate') }}">Corporate Law</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/practice/civil') }}">Civil Law</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/practice/criminal') }}">Criminal Law</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/practice/family') }}">Family Law</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/practice/employment') }}">Employment Law</a>
			</div>
			<div>
				<div class="px-2 py-1 text-xs uppercase text-gray-500 flex items-center justify-between">
					<span>Our Services</span>
					<a href="{{ route('services.index') }}" class="text-purple-600 hover:text-purple-700 font-medium normal-case">View All</a>
				</div>
				@if(isset($navServices) && $navServices->count() > 0)
					@foreach($navServices->take(6) as $service)
					<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ route('service.show', $service->slug) }}">
						<div class="flex items-center gap-2">
							<svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
							</svg>
							<span>{{ $service->title }}</span>
						</div>
					</a>
					@endforeach
					@if($navServices->count() > 6)
					<a class="block px-2 py-2 rounded bg-purple-50 text-purple-700 font-medium text-center" href="{{ route('services.index') }}">
						View All {{ $navServices->count() }} Services →
					</a>
					@endif
				@else
					<div class="px-2 py-4 text-gray-500 text-sm text-center">
						No services available
					</div>
				@endif
			</div>
			<div>
				<div class="px-2 py-1 text-xs uppercase text-gray-500 flex items-center justify-between">
					<span>Practices</span>
					<a href="{{ route('practices.index') }}" class="text-green-600 hover:text-green-700 font-medium normal-case">View All</a>
				</div>
				@if(isset($navPublications) && $navPublications->count() > 0)
					@foreach($navPublications->take(6) as $practice)
					<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ route('practice.show', $practice->slug) }}">
						<div class="flex items-center gap-2">
							<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
							</svg>
							<span>{{ $practice->title }}</span>
						</div>
					</a>
					@endforeach
					@if($navPublications->count() > 6)
					<a class="block px-2 py-2 rounded bg-green-50 text-green-700 font-medium text-center" href="{{ route('practices.index') }}">
						View All {{ $navPublications->count() }} Practices →
					</a>
					@endif
				@else
					<div class="px-2 py-4 text-gray-500 text-sm text-center">
						No practices available
					</div>
				@endif
			</div>
			<div>
				<div class="px-2 py-1 text-xs uppercase text-gray-500">News</div>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/news') }}">Latest News</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/articles') }}">Legal Articles</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/newsletters') }}">Newsletters</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/resources') }}">Resources</a>
			</div>
			<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/team') }}">Our Team</a>
			<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/contact') }}">Contact Us</a>
			<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/court-fee-calculator') }}">Court Fee Calculator</a>
			<div>
				<div class="px-2 py-1 text-xs uppercase text-gray-500">Language</div>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/lang/en') }}">English</a>
				<a class="block px-2 py-2 rounded hover:bg-gray-50" href="{{ url('/lang/ne') }}">नेपाली</a>
			</div>
		</div>
	</div>
</header>


