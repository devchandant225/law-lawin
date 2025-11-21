/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // Scan all Blade templates in views folder
        "./resources/views/**/*.blade.php",
        // Include JavaScript files
        "./resources/js/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#1d5e7d",
                secondary: "#d0700b",
                accent: "#108fcc",
                nav: "#00000",
            },
        },
    },
    plugins: [],
};
