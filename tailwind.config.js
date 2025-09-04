/** @type {import('tailwindcss').Config} */
export default {
	content: [
		// Scan all Blade templates in views folder
		'./resources/views/**/*.blade.php',
		// Include JavaScript files
		'./resources/js/**/*.js',
	],
	theme: {
		extend: {
			colors: {
				primary: '#0C2924', 
				secondary: '#567470', 
				accent: '#F3EEED', 
			},
		},
	},
	plugins: [],
};


