<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>

                #logo{

                width: 200px; /* Bạn có thể thay đổi kích thước này */
                height: auto; /* Giữ tỷ lệ hình ảnh */


                }


             @media (max-width: 768px) {
                .body{
                    font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    color: #111827;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
                    
                }


      
                    
            .text-input-1{

            border-color: #d1d5db; /* gray-300 */
            background-color: #1a202c; /* gray-900 */
            color: #d1d5db; /* gray-300 */
            border-radius: 1rem; /* rounded-md */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
            }
            .text-input-1:focus {
            border-color: #6366f1; /* indigo-500 */
            outline: none; /* focus:ring */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5); /* focus:ring-indigo-500 */
            }


            #input-email{

                margin-right: 30px;
            } 
            #password-div{
                margin-top: 30px;
            }              
}
             #body-1{
                min-height: 100vh; /* min-h-screen: Chiều cao tối thiểu bằng chiều cao viewport */
                display: flex;
                flex-direction: column;
                align-items: center; 
                padding-bottom: 0;

                justify-content: center; /* sm:justify-center: Canh giữa các phần tử con theo trục dọc */
        padding-top: 0;
             }
            


     
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div id = "body-1"class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/" wire:navigate>
                    <img src="{{ asset('images/Artboard22.png') }}" alt="Park Ease Logo" id="logo">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
