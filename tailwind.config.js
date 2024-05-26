import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
content: [
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
'./storage/framework/views/*.php',
'./resources/views/**/*.blade.php',
],

theme: {
extend: {
fontFamily: {
sans: ['Figtree', ...defaultTheme.fontFamily.sans],
'logo': 'League Gothic'
},
colors: {
'primary': '#03438a',
'secondary': '#455a64',
'background-hover': '#1B3C73',
'link' : '#3C50E0',
'text-title' : '#111827',
'text-desc' : '#6b7280',
'white-text' : '#f9fafb'
},
},
},

plugins: [
    forms,
],
};
