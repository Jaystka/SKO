<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="h-16 flex items-center justify-center border-b">
                <h1 class="text-2xl font-bold text-gray-700">SKO</h1>
            </div>
            <nav class="p-4">
                <ul class="space-y-4">
                    <li><a href="#" class="flex items-center text-gray-700 hover:text-gray-900 hover:bg-gray-200 p-2 rounded"><i class="fas fa-tachometer-alt w-5"></i><span class="ml-4">Dashboard</span></a></li>
                    <li><a href="#" class="flex items-center text-gray-700 hover:text-gray-900 hover:bg-gray-200 p-2 rounded"><i class="fas fa-box w-5"></i><span class="ml-4">Products</span></a></li>
                    <li><a href="#" class="flex items-center text-gray-700 hover:text-gray-900 hover:bg-gray-200 p-2 rounded"><i class="fas fa-tags w-5"></i><span class="ml-4">Category</span></a></li>
                    <li><a href="#" class="flex items-center text-gray-700 hover:text-gray-900 hover:bg-gray-200 p-2 rounded"><i class="fas fa-users w-5"></i><span class="ml-4">Customers</span></a></li>
                    <li><a href="#" class="flex items-center text-gray-700 hover:text-gray-900 hover:bg-gray-200 p-2 rounded"><i class="fas fa-shopping-cart w-5"></i><span class="ml-4">Sells</span></a></li>
                    <li><a href="#" class="flex items-center text-gray-700 hover:text-gray-900 hover:bg-gray-200 p-2 rounded"><i class="fas fa-clipboard-list w-5"></i><span class="ml-4">Materials</span></a></li>
                </ul>
            </nav>
            <div class="p-4">
                <button class="w-full bg-red-500 text-white p-2 rounded hover:bg-red-600">Log out</button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Search Bar -->
            <div class="flex justify-end mb-6">
                <input type="text" class="p-2 rounded border border-gray-300 w-full md:w-1/3" placeholder="Search...">
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
                <!-- Income -->
                <div class="bg-white p-6 shadow rounded">
                    <h2 class="text-gray-700 text-lg font-semibold">Income</h2>
                    <p class="text-gray-400 text-sm">Juni 2024</p>
                    <p class="text-2xl font-bold">Rp. 7.987.562</p>
                </div>
                <!-- Expenses -->
                <div class="bg-white p-6 shadow rounded">
                    <h2 class="text-gray-700 text-lg font-semibold">Expenses</h2>
                    <p class="text-gray-400 text-sm">Juni 2024</p>
                    <p class="text-2xl font-bold">Rp. 2.551.812</p>
                </div>
                <!-- Balance -->
                <div class="bg-white p-6 shadow rounded">
                    <h2 class="text-gray-700 text-lg font-semibold">Balance</h2>
                    <p class="text-gray-400 text-sm">Juni 2024</p>
                    <p class="text-2xl font-bold">Rp. 1.575.235</p>
                </div>
            </div>

            <!-- Chart -->
            <div class="bg-white p-6 shadow rounded mb-6">
                <h2 class="text-gray-700 text-lg font-semibold">Chart Title</h2>
                <canvas id="chart" class="mt-4"></canvas>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white p-6 shadow rounded">
                <h2 class="text-gray-700 text-lg font-semibold">Recent Order</h2>
                <ul class="mt-4 space-y-4">
                    <li class="flex justify-between items-center border-b pb-4">
                        <div>
                            <p class="text-gray-700">Proto Lite Purple</p>
                            <p class="text-gray-400 text-sm">Sepatu Compass | 1 pcs</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-700 font-bold mr-4">Rp. 408.000</p>
                            <button class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Accept</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center border-b pb-4">
                        <div>
                            <p class="text-gray-700">Gazelle Black Gum</p>
                            <p class="text-gray-400 text-sm">Sepatu Compass | 1 pcs</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-700 font-bold mr-4">Rp. 538.000</p>
                            <button class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Accept</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center border-b pb-4">
                        <div>
                            <p class="text-gray-700">Retrograde White Blue</p>
                            <p class="text-gray-400 text-sm">Sepatu Compass | 1 pcs</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-700 font-bold mr-4">Rp. 538.000</p>
                            <button class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Accept</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center border-b pb-4">
                        <div>
                            <p class="text-gray-700">Retrograde White Blue</p>
                            <p class="text-gray-400 text-sm">Sepatu Compass | 1 pcs</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-700 font-bold mr-4">Rp. 538.000</p>
                            <button class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Accept</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center border-b pb-4">
                        <div>
                            <p class="text-gray-700">Retrograde White Blue</p>
                            <p class="text-gray-400 text-sm">Sepatu Compass | 1 pcs</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-700 font-bold mr-4">Rp. 538.000</p>
                            <button class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Accept</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
</body>
</html>
