/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.js',
	],
	theme: {
		extend: {
			colors: {
				primary: '#7e22ce ', // Purple - primary brand color
				secondary: '#b1ac6a', // Gold - secondary brand color
				accent: '#e7e8f0', // Light background accent
			},
		},
	},
	plugins: [],
};


