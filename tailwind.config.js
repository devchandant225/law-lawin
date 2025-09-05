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
                primary: "#1E698D",
                secondary: "#FOBB29",
                accent: "#FFFFFF",
            },
        },
    },
    plugins: [],
};
