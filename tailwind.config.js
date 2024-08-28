import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/preline/dist/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                "border-gradient": {
                    "0%, 100%": {
                        "border-color": "rgba(0, 143, 255, 1)",
                    },
                    "50%": {
                        "border-color": "rgba(255, 0, 143, 1)",
                    },
                },
            },
            animation: {
                "border-gradient": "border-gradient 3s infinite",
            },
        },
    },

    plugins: [
        forms,
        typography,
        require("flowbite/plugin"),
        require("preline/plugin"),
    ],
};
