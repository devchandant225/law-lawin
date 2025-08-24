/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.js',
	],
	theme: {
		extend: {
			colors: {
				primary: '#6F64D3', // Purple - primary brand color
				secondary: '#ADA769', // Gold - secondary brand color
				accent: '#F8F9FA', // Light background accent
			},
		},
	},
	plugins: [],
};


