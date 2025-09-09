import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
         './vendor/livewire/flux/dist/flux.css',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', 'sans-serif'],
            },

        },
    },
    darkMode: "class",

    daisyui: {
    themes: [
      {
        mytheme: {
          "primary": "#22c55e",   // Green-500
          "secondary": "#64748b", // Slate-500
          "accent": "#22d3ee",    // Cyan-400
          "neutral": "#1e293b",   // Slate-800
          "base-100": "#ffffff",  // Background
          "info": "#3b82f6",      // Blue-500
          "success": "#22c55e",   
          "warning": "#facc15",   // Yellow-400
          "error": "#ef4444",     // Red-500
        }, 
      },

    ],
  },


    plugins: [ daisyui],
};
