/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/js/**/*.jsx",
        "./resources/js/**/*.tsx",
        "./app/Services/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                'orange-primary': '#EE5A24',
                'orange-construction': '#EE5A24',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
