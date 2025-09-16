<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Nahi Mila - 404</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #1f2937, #374151);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
    </style>
</head>
<body class="selection:bg-pink-500 selection:text-white">
    <div class="relative w-full max-w-2xl text-center">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0 opacity-20">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <radialGradient id="grad1" cx="50%" cy="50%" r="50%" fx="50%" fy="50%">
                        <stop offset="0%" style="stop-color:#f472b6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:0" />
                    </radialGradient>
                </defs>
                <circle cx="50" cy="50" r="45" fill="url(#grad1)" class="animate-pulse" />
            </svg>
        </div>

        <div class="relative z-10 flex flex-col items-center">
            <!-- Dynamic 404 Text -->
            <div class="relative mb-8 text-white">
                <span class="text-9xl md:text-[12rem] lg:text-[15rem] font-extrabold text-white text-opacity-10 animate-fade-in">404</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-7xl md:text-8xl lg:text-9xl font-bold text-red-500 transform -rotate-6 transition-transform hover:scale-110">
                        4<span class="text-pink-500">0</span>4
                    </span>
                </div>
            </div>

            <h1 class="text-3xl md:text-5xl font-extrabold mb-2 leading-tight">
                Rasta Gum Ho Gaya Hai!
            </h1>
            <p class="text-lg md:text-xl text-gray-400 max-w-md mb-8">
                Maaf keejiye, aap jis page ki talash kar rahe hain woh ab maujood nahi hai. Shayad aap galat mod par aa gaye hain.
            </p>

            <a href="/" class="group relative px-6 py-3 font-bold text-white rounded-full bg-pink-500 hover:bg-pink-600 transition-colors focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                <span class="absolute inset-0 w-0 transition-all duration-300 ease-out bg-pink-600 group-hover:w-full rounded-full"></span>
                <span class="relative">Homepage par wapas jaayein</span>
            </a>
        </div>
    </div>
</body>
</html>
