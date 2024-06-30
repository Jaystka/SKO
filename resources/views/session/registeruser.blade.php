<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKO Login Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-[#F8F7F3]">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Left Section -->
        <div class="flex-1 bg-cover bg-center relative" style="background-image: url('img/registeruser.png');">
            <div class="absolute inset-0 bg-[#FFF3B2] opacity-25"></div>
            <div class="relative z-10 flex items-center justify-center h-full p-8">
                <div class="text-center text-white">
                    <h1 class="text-4xl font-bold bodycopy">Berkarya dengan gaya</h1>
                    <h2 class="logosko text-7xl font-bold mt-2">SKO<span class="bodycopy text-4xl mt-10 font-bold">
                            selalu tersedia</span></h2>
                </div>
            </div>
        </div>
        <!-- Right Section -->
        <div class="flex-1 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-center ">Welcome to SKO!</h2>
                <h3 class="text-md font-normal text-center mb-8">Create an Account</h3>
                <form class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-black">Username</label>
                        <input type="username" id="username"
                            class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Username">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-black">Email</label>
                        <input type="email" id="email"
                            class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Email">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-black">Password</label>
                        <input type="password" id="password"
                            class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Password">
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-3/4 py-5 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-gray-700 bg-[#FFF3B5] hover:bg-gray-700 hover:text-[#FFF3B5] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign
                            in</button>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-black">Already have an account? <a href="/login"
                                class="font-medium text-indigo-600 hover:text-indigo-500">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>