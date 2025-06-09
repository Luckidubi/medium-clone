import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                "2xl": ["1.5rem", { lineHeight: "2rem" }],
                "3xl": ["1.875rem", { lineHeight: "2.25rem" }],
                "4xl": ["2.25rem", { lineHeight: "2.5rem" }],
            },
            spacing: {
                "2xs": "0.125rem",
                "3xs": "0.1875rem",
                "4xs": "0.25rem",
                "5xs": "0.3125rem",
            },
            lineHeight: {
                "2xs": "1rem",
                "3xs": "0.75rem",
                "4xs": "0.5rem",
                "5xs": "0.25rem",
            },
            
        },

        plugins: [forms],
    },
};
