{{-- Modern Footer --}}
<footer class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white overflow-hidden">
	{{-- Background Elements --}}
	<div class="absolute inset-0 opacity-5">
		<div class="absolute top-10 left-10 w-20 h-20 bg-primary rounded-full animate-pulse"></div>
		<div class="absolute top-32 right-20 w-16 h-16 bg-secondary rounded-full animate-pulse"
			style="animation-delay: 2s;"></div>
		<div class="absolute bottom-20 left-1/3 w-12 h-12 bg-yellow-400 rounded-full animate-pulse"
			style="animation-delay: 4s;"></div>
	</div>

	<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-12">
			{{-- Organization Info Section --}}
			<div class="space-y-6 lg:col-span-6 xl:col-span-6">
				{{-- Logo --}}
				<a href="{{ url('/') }}" class="group flex items-center gap-4 transition-transform hover:scale-105">
					<div class="relative">
						<div
							class="h-12 w-12 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center shadow-xl group-hover:shadow-primary/25 transition-all">
							<svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M12,4A1,1 0 0,0 11,5V11A1,1 0 0,0 12,12A1,1 0 0,0 13,11V5A1,1 0 0,0 12,4M7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12V13H19V12A7,7 0 0,0 12,5A7,7 0 0,0 5,12V13H7V12Z" />
							</svg>
						</div>
						<div
							class="absolute -bottom-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center">
							<svg class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="currentColor">
								<path d="M12,2L13.09,8.26L22,9L13.09,9.74L12,16L10.91,9.74L2,9L10.91,8.26L12,2Z" />
							</svg>
						</div>
					</div>
					<div>
						<div class="text-xl font-bold group-hover:text-primary transition-colors">Plant Breeding</div>
						<div class="text-lg text-secondary font-medium -mt-1">& Genetics Society</div>
					</div>
				</a>

				{{-- Mission Statement --}}
				<p class="text-gray-300 leading-relaxed">
					Advancing research, collaboration, and knowledge sharing in plant breeding and genetics.
					Building a sustainable future through innovative agricultural science.
				</p>

				{{-- Contact Information --}}
				<div class="space-y-3">
					<div class="flex items-center gap-3 text-gray-300 hover:text-white transition-colors group">
						<div
							class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/30 transition-colors">
							<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
							</svg>
						</div>
						<div>
							<div class="font-medium">Email us</div>
							<a href="mailto:contact@plantbreeding.org"
								class="text-sm text-gray-400 hover:text-secondary transition-colors">contact@plantbreeding.org</a>
						</div>
					</div>

					<div class="flex items-center gap-3 text-gray-300 hover:text-white transition-colors group">
						<div
							class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/30 transition-colors">
							<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z" />
							</svg>
						</div>
						<div>
							<div class="font-medium">Call us</div>
							<a href="tel:+8801234567890"
								class="text-sm text-gray-400 hover:text-secondary transition-colors">+880 123 456
								7890</a>
						</div>
					</div>

					<div class="flex items-center gap-3 text-gray-300">
						<div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center">
							<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
							</svg>
						</div>
						<div>
							<div class="font-medium">Visit us</div>
							<div class="text-sm text-gray-400">Dhaka, Bangladesh</div>
						</div>
					</div>
				</div>
			</div>

			{{-- Quick Links --}}
				<div class="space-y-6 lg:col-span-3">
					<div>
						<h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
							<svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M12,4A1,1 0 0,0 11,5V11A1,1 0 0,0 12,12A1,1 0 0,0 13,11V5A1,1 0 0,0 12,4M7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12V13H19V12A7,7 0 0,0 12,5A7,7 0 0,0 5,12V13H7V12Z" />
							</svg>
							Quick Links
						</h4>
						<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
							<a href="{{ url('/about/introduction') }}"
								class="flex items-center gap-2 text-gray-300 hover:text-white transition-colors group">
								<svg class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
								</svg>
								About Us
							</a>
							<a href="{{ url('/information/notices') }}"
								class="flex items-center gap-2 text-gray-300 hover:text-white transition-colors group">
								<svg class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M5,7H19V5H5V7Z" />
								</svg>
								Notices
							</a>
							<a href="{{ url('/information/events') }}"
								class="flex items-center gap-2 text-gray-300 hover:text-white transition-colors group">
								<svg class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" />
								</svg>
								Events
							</a>
							<a href="{{ url('/publications/journal') }}"
								class="flex items-center gap-2 text-gray-300 hover:text-white transition-colors group">
								<svg class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
								</svg>
								Journal
							</a>
							<a href="{{ url('/membership/register') }}"
								class="flex items-center gap-2 text-gray-300 hover:text-white transition-colors group">
								<svg class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M15,14C12.33,14 7,15.33 7,18V20H23V18C23,15.33 17.67,14 15,14M6,10V7H4V10H1V12H4V15H6V12H9V10M15,12A4,4 0 0,0 19,8A4,4 0 0,0 15,4A4,4 0 0,0 11,8A4,4 0 0,0 15,12Z" />
								</svg>
								Membership
							</a>
							<a href="{{ url('/contact') }}"
								class="flex items-center gap-2 text-gray-300 hover:text-white transition-colors group">
								<svg class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path d="M22,4C22,2.89 21.1,2 20,2H4A2,2 0 0,0 2,4V16A2,2 0 0,0 4,18H18L22,22V4Z" />
								</svg>
								Contact
							</a>
						</div>
					</div>
				</div>

				{{-- Social Media & Newsletter --}}
				<div class="space-y-6 lg:col-span-3">
					{{-- Social Media --}}
					<div>
						<h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
							<svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M18,16.08C17.24,16.08 16.56,16.38 16.04,16.85L8.91,12.7C8.96,12.47 9,12.24 9,12C9,11.76 8.96,11.53 8.91,11.3L15.96,7.19C16.5,7.69 17.21,8 18,8A3,3 0 0,0 21,5A3,3 0 0,0 18,2A3,3 0 0,0 15,5C15,5.24 15.04,5.47 15.09,5.7L8.04,9.81C7.5,9.31 6.79,9 6,9A3,3 0 0,0 3,12A3,3 0 0,0 6,15C6.79,15 7.5,14.69 8.04,14.19L15.16,18.34C15.11,18.55 15.08,18.77 15.08,19C15.08,20.61 16.39,21.91 18,21.91C19.61,21.91 20.92,20.61 20.92,19A2.92,2.92 0 0,0 18,16.08Z" />
							</svg>
							Connect
						</h4>
						<div class="flex flex-wrap gap-3">
							<a href="https://facebook.com/plantbreedingbd" target="_blank" rel="noopener"
								aria-label="Facebook"
								class="group w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-700 transition-all hover:scale-110 shadow-lg hover:shadow-blue-600/25">
								<svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M22 12.06C22 6.48 17.52 2 11.94 2S2 6.48 2 12.06c0 5.02 3.66 9.19 8.44 9.94v-7.03H7.9v-2.91h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.55v1.86h2.76l-.44 2.91h-2.32v7.03C18.34 21.25 22 17.08 22 12.06z" />
								</svg>
							</a>
							<a href="https://twitter.com/plantbreedingbd" target="_blank" rel="noopener"
								aria-label="Twitter"
								class="group w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center hover:bg-blue-500 transition-all hover:scale-110 shadow-lg hover:shadow-blue-400/25">
								<svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.05C2.38,12.15 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,15.98 6.05,17.21 7.96,17.25C6.5,18.37 4.68,19.02 2.72,19.02C2.38,19.02 2.04,19 1.71,18.96C3.64,20.14 5.96,20.82 8.45,20.82C16,20.82 20.33,14.46 20.33,9.79C20.33,9.6 20.33,9.42 20.32,9.23C21.16,8.63 21.88,7.87 22.46,6Z" />
								</svg>
							</a>
							<a href="https://linkedin.com/company/plantbreedingbd" target="_blank" rel="noopener"
								aria-label="LinkedIn"
								class="group w-12 h-12 bg-blue-700 rounded-xl flex items-center justify-center hover:bg-blue-800 transition-all hover:scale-110 shadow-lg hover:shadow-blue-700/25">
								<svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M20.47,2H3.53A1.45,1.45 0 0,0 2.06,3.43V20.57A1.45,1.45 0 0,0 3.53,22H20.47A1.45,1.45 0 0,0 21.94,20.57V3.43A1.45,1.45 0 0,0 20.47,2M8.09,18.74H5.09V9.69H8.09M6.59,8.48C5.61,8.48 4.82,7.69 4.82,6.71C4.82,5.73 5.61,4.94 6.59,4.94C7.57,4.94 8.36,5.73 8.36,6.71C8.36,7.69 7.57,8.48 6.59,8.48M18.91,18.74H15.91V14.37C15.91,13.22 15.91,11.71 14.29,11.71C12.65,11.71 12.42,12.95 12.42,14.29V18.74H9.42V9.69H12.3V11.09H12.34C12.73,10.38 13.71,9.63 15.18,9.63C18.22,9.63 18.91,11.69 18.91,14.37V18.74Z" />
								</svg>
							</a>
							<a href="https://instagram.com/plantbreedingbd" target="_blank" rel="noopener"
								aria-label="Instagram"
								class="group w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-500 rounded-xl flex items-center justify-center hover:from-purple-700 hover:to-pink-600 transition-all hover:scale-110 shadow-lg hover:shadow-purple-500/25">
								<svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform"
									viewBox="0 0 24 24" fill="currentColor">
									<path
										d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm10 2H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3zm-5 3.5A5.5 5.5 0 1 1 6.5 13 5.5 5.5 0 0 1 12 7.5zm0 2A3.5 3.5 0 1 0 15.5 13 3.5 3.5 0 0 0 12 9.5zM18 6.9a1.1 1.1 0 1 1-1.1 1.1A1.1 1.1 0 0 1 18 6.9z" />
								</svg>
							</a>
						</div>
					</div>

					{{-- Newsletter Signup --}}
					<div
						class="bg-gradient-to-br from-primary/20 to-secondary/20 rounded-2xl p-6 border border-primary/30">
						<h4 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
							<svg class="w-5 h-5 text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
								<path
									d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
							</svg>
							Stay Updated
						</h4>
						<p class="text-gray-300 text-sm mb-4">Get the latest news and research updates from our
							community.</p>
						<div class="flex flex-col sm:flex-row gap-2">
							<input type="email" placeholder="Enter your email"
								class="w-full sm:flex-1 px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
							<button
								class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg hover:from-secondary hover:to-primary transition-all hover:scale-105 font-medium">
								Join
							</button>
						</div>
					</div>
				</div>


		
			{{-- Map --}}
			<div class="mt-10 lg:col-span-6 xl:col-span-6">
				<div class="rounded-2xl overflow-hidden ring-1 ring-white/10 shadow-xl">
					<iframe
						title="Map - Dhaka, Bangladesh"
						class="w-full h-64 md:h-80"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						src="https://maps.google.com/maps?q=Dhaka%2C%20Bangladesh&t=&z=12&ie=UTF8&iwloc=&output=embed"></iframe>
				</div>
			</div>

		</div>
		<div class="border-t border-white/15">
			<div
				class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-white/80">
				<div>&copy; {{ date('Y') }} {{ config('app.name', 'Professional Organization') }}. All rights reserved.
				</div>
				<div class="mt-3 md:mt-0 flex items-center gap-4">
					<a class="hover:text-white" href="{{ url('/') }}">Home</a>
					<a class="hover:text-white" href="{{ url('/publications/journal') }}">Journal</a>
					<a class="hover:text-white" href="{{ url('/information/events') }}">Events</a>
					<a class="hover:text-white" href="{{ url('/contact') }}">Contact</a>
				</div>
			</div>
		</div>
</footer>