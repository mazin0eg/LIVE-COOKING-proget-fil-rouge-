<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .recipe-card {
            transition: all 0.3s ease;
        }
        
        .recipe-card:hover {
            transform: translateY(-5px);
        }

        .tab-active {
            border-bottom: 2px solid #EF4444;
            color: #EF4444;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
     <x-navbar />

    <!-- Profile Header -->
    <section class="bg-white border-b">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
                <!-- Profile Image -->
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                         alt="Profile Picture" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    <button class="absolute bottom-0 right-0 bg-red-500 text-white rounded-full p-2 shadow-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-1">mazin0eg</h1>
                            <p class="text-gray-500">Member since March 2025</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <button class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 transition-colors">
                                Edit Profile
                            </button>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-center md:justify-start space-x-8 mt-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">127</div>
                            <div class="text-sm text-gray-500">Recipes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">15.4K</div>
                            <div class="text-sm text-gray-500">Followers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">892</div>
                            <div class="text-sm text-gray-500">Following</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <!-- Tabs -->
            <div class="flex justify-center mb-8 border-b">
                <button class="px-6 py-3 text-gray-600 hover:text-red-500 tab-active">
                    My Recipes
                </button>
                <button class="px-6 py-3 text-gray-600 hover:text-red-500">
                    Saved Recipes
                </button>
                <button class="px-6 py-3 text-gray-600 hover:text-red-500">
                    Collections
                </button>
                <button class="px-6 py-3 text-gray-600 hover:text-red-500">
                    Activity
                </button>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Recipe Card -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                             alt="Creamy Pasta" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            4.8
                        </div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm hover:bg-white transition-colors">
                                <i class="fas fa-edit text-gray-600"></i>
                            </button>
                            <button class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm hover:bg-white transition-colors">
                                <i class="fas fa-trash text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Creamy Garlic Mushroom Pasta</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 25 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-utensils mr-1"></i> 4 servings
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="text-xs text-gray-500">Posted on Mar 17, 2025</span>
                            </div>
                            <div class="flex items-center space-x-2 text-gray-500">
                                <span class="text-xs flex items-center">
                                    <i class="far fa-heart mr-1"></i> 234
                                </span>
                                <span class="text-xs flex items-center">
                                    <i class="far fa-comment mr-1"></i> 18
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more recipe cards here -->
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-8">
                <button class="bg-gray-100 text-gray-600 px-6 py-2 rounded-full hover:bg-gray-200 transition-colors">
                    Load More
                </button>
            </div>
        </div>
    </section>

    <!-- Create Recipe Button -->
    <button class="fixed bottom-6 right-6 bg-red-500 text-white rounded-full p-4 shadow-lg hover:bg-red-600 transition-colors">
        <i class="fas fa-plus text-xl"></i>
    </button>

    <!-- Footer could go here -->
    <x-footer />
</body>
</html>