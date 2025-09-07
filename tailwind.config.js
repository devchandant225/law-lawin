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
                primary: "#70bfce",
                secondary: "#a8c2c7",
                accent: "#a8c2c7",
            },
        },
    },
    plugins: [],
};
