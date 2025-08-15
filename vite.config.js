import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss({
            content: [
                "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
                "./storage/framework/views/*.php",
                "./resources/views/**/*.blade.php",
                "./resources/views/livewire/**/*.blade.php",
                "./app/Livewire/**/*.php",
            ],
            theme: {
                extend: {
                    colors: {
                        "african-green": "#2D5016",
                        "african-orange": "#FF6B35",
                        "light-green": "#4A7C59",
                        cream: "#F5F5DC",
                    },
                },
            },
        }),
    ],
    server: {
        cors: true,
    },
});
