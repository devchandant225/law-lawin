/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.js',
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


