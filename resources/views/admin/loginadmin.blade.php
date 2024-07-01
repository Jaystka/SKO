<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-[#F8F7F3] flex items-center justify-center h-screen">
    <div class="w-full max-w-sm mx-auto p-4 rounded-lg">
        <div class="flex justify-center mb-6">
            <h1 class="text-3xl font-bold logosko">SKO</h1>
        </div>
        <form class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-bold text-[#3C4043]">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-[#3C4043] rounded-md shadow-sm focus:outline-none focus:ring focus:ring-black hover:border-black" placeholder="Enter your email">
            </div>
            <div>
                <label for="password" class="block text-sm font-bold text-[#3C4043]">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-black hover:border-black" placeholder="Enter your password">
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.086.34-.37.684-.87 1.017a4.002 4.002 0 00-5.157-5.157c-.333.5-.677.784-1.017.87-4.057 1.274-7 5.065-7 9.542 0 .333.05.668.146 1"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-center">
                <a href="#" class="text-sm font-semibold text-[#3C4043] hover:underline">Forgot password?</a>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="w-72 px-2 py-5 bg-slate-500 shadow-md bodycopy font-bold text-black rounded-md hover:bg-yellow-100 focus:outline-none focus:bg-yellow-200">Sign in</button>
            </div>
        </form>
    </div>
</body>
</html>
