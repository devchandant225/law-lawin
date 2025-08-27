/** @type {import('tailwindcss').Config} */
export default {
	content: [
		// Only scan admin-related files for Tailwind classes
		'./resources/views/admin/**/*.blade.php',
		'./resources/views/layouts/admin.blade.php',
		'./resources/views/layouts/partials/admin-*.blade.php',
		// Add any admin-specific JavaScript files if needed
		'./resources/js/admin.js',
	],
	theme: {
		extend: {
			colors: {
				primary: '#6F64D3 ', // Purple - primary brand color
				secondary: '#b1ac6a', // Gold - secondary brand color
				accent: '#e7e8f0', // Light background accent
			},
		},
	},
	plugins: [],
};


