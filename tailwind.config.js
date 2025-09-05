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
                primary: "#0C2924",
                secondary: "#1a3247",
                accent: "#4a6b85",
            },
        },
    },
    plugins: [],
};
