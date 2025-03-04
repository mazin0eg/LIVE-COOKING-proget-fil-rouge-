<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - Recipe Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .recipe-card {
            transition: all 0.2s ease;
        }
        
        .recipe-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .heart-button {
            transition: all 0.2s ease;
        }
        
        .heart-button:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white py-3 px-6 shadow-sm sticky top-0 z-50">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="bg-red-500 rounded text-white p-1.5 mr-2">
                    <i class="fas fa-utensils"></i>
                </div>
                <span class="text-xl font-bold text-gray-800">Platea</span>
            </div>
            
            <!-- Menu Items -->
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Home</a>
                <a href="#" class="text-gray-800 font-medium hover:text-red-500 transition-colors">About</a>
                <a href="#" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Recipes</a>
                <a href="#" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Cuisines</a>
                <a href="#" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Articles</a>
                <a href="#" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Contact</a>
            </div>
            
            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-red-500 transition-colors">
                    <i class="fas fa-search"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-red-500 transition-colors">
                    <i class="fas fa-user"></i>
                </a>
                <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition-colors shadow-sm">Sign in</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gray-200">
        <!-- Background image overlay with gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-gray-900/40" style="background-image: url('https://images.unsplash.com/photo-1495521821757-a1efb6729352?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; opacity: 0.9"></div>
        
        <div class="container mx-auto px-6 py-16 flex relative z-10">
            <div class="w-full md:w-1/2 my-auto">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                    You don't know how to make the dish you have in mind?
                </h1>
                <p class="text-gray-100 mb-8 text-lg">
                    Feed your imagination and spark your creativity. From cravings to creations.
                </p>
                <div class="bg-white rounded-full shadow-md flex items-center p-1 pl-5 mb-4 max-w-md">
                    <input 
                        type="text" 
                        placeholder="Find what do you want to cook today" 
                        class="flex-grow outline-none text-gray-700 py-2.5"
                    >
                    <button class="bg-red-500 hover:bg-red-600 text-white rounded-full p-3 transition-colors shadow-sm">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm transition-all flex items-center">
                        <i class="fas fa-play-circle mr-2"></i> Watch tutorials
                    </a>
                    <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm transition-colors shadow-sm">
                        Browse recipes
                    </a>
                </div>
            </div>
            <div class="hidden md:block md:w-1/2 relative">
                <!-- Recipe image here - we'll keep this empty as in the original -->
            </div>
        </div>
    </section>

    <!-- Category Pills -->
    <section class="py-6 px-4 bg-white border-b border-gray-100">
        <div class="container mx-auto">
            <div class="flex overflow-x-auto py-2 space-x-3 no-scrollbar">
                <button class="bg-red-500 text-white px-5 py-2 rounded-full text-sm whitespace-nowrap">All Recipes</button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-full text-sm whitespace-nowrap transition-colors">Breakfast</button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-full text-sm whitespace-nowrap transition-colors">Lunch</button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-full text-sm whitespace-nowrap transition-colors">Dinner</button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-full text-sm whitespace-nowrap transition-colors">Vegetarian</button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-full text-sm whitespace-nowrap transition-colors">Quick & Easy</button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-full text-sm whitespace-nowrap transition-colors">Desserts</button>
            </div>
        </div>
    </section>

    <!-- Latest Recipes -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold mb-0">Latest Recipes</h2>
                <div class="flex space-x-2">
                    <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full text-gray-600 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="p-2 bg-red-500 text-white rounded-full transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Recipe Card 1 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Creamy pasta" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            4.8
                        </div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
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
                                <i class="fas fa-fire-alt mr-1"></i> 320 cal
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                <span class="text-xs text-gray-500">John Cook</span>
                            </div>
                            <span class="text-xs text-gray-500">2 days ago</span>
                        </div>
                    </div>
                </div>

                <!-- Recipe Card 2 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Soup" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            4.5
                        </div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Vegetable Lentil Soup</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 45 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-fire-alt mr-1"></i> 220 cal
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                <span class="text-xs text-gray-500">Sarah Baker</span>
                            </div>
                            <span class="text-xs text-gray-500">3 days ago</span>
                        </div>
                    </div>
                </div>

                 <!-- Recipe Card 1 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Creamy pasta" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            4.8
                        </div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
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
                                <i class="fas fa-fire-alt mr-1"></i> 320 cal
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                <span class="text-xs text-gray-500">John Cook</span>
                            </div>
                            <span class="text-xs text-gray-500">2 days ago</span>
                        </div>
                    </div>
                </div>


                 <!-- Recipe Card 1 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Creamy pasta" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            4.8
                        </div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
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
                                <i class="fas fa-fire-alt mr-1"></i> 320 cal
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                <span class="text-xs text-gray-500">John Cook</span>
                            </div>
                            <span class="text-xs text-gray-500">2 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- "Discover Fresh Recipes" Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2 p-8 md:p-12 flex items-center">
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Discover fresh and easy recipes to inspire your meals every day</h2>
                            <p class="text-gray-600 mb-6">Our chef-tested recipes use fresh ingredients and simple techniques to create dishes that will impress your family and friends.</p>
                            <div class="flex flex-wrap gap-3 mb-6">
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Quick & Easy</span>
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Family Friendly</span>
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Budget Meals</span>
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Healthy Options</span>
                            </div>
                            <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full inline-block transition-colors shadow-sm">Explore Collection</a>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Fresh ingredients" class="w-full h-64 md:h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Recipes Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">New Recipes</h2>
                <a href="#" class="text-red-500 font-medium hover:underline">View All</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- New Recipe Card 1 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Avocado Salad" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">New</div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm">
                            <img src="https://flagcdn.com/w20/mx.png" alt="Mexico" class="h-4 w-4 mr-1.5 rounded-full object-cover border border-gray-200">
                            Mexican
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Fresh Avocado & Citrus Salad</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 15 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-user-friends mr-1"></i> 2 servings
                            </span>
                        </div>
                    </div>
                </div>

                <!-- New Recipe Card 2 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Pancakes" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">New</div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm">
                            <img src="https://flagcdn.com/w20/us.png" alt="USA" class="h-4 w-4 mr-1.5 rounded-full object-cover border border-gray-200">
                            American
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Fluffy Banana Pancakes Stack</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 20 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-user-friends mr-1"></i> 4 servings
                            </span>
                        </div>
                    </div>
                </div>

                <!-- New Recipe Card 3 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1585032226651-759b368d7246?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Thai Curry" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">New</div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm">
                            <img src="https://flagcdn.com/w20/th.png" alt="Thailand" class="h-4 w-4 mr-1.5 rounded-full object-cover border border-gray-200">
                            Thai
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Spicy Thai Green Curry</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 35 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-user-friends mr-1"></i> 3 servings
                            </span>
                        </div>
                    </div>
                </div>

                <!-- New Recipe Card 4 -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Mediterranean plate" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">New</div>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm">
                            <img src="https://flagcdn.com/w20/gr.png" alt="Greece" class="h-4 w-4 mr-1.5 rounded-full object-cover border border-gray-200">
                            Mediterranean
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Mediterranean Mezze Platter</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 40 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-user-friends mr-1"></i> 6 servings
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Journal Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">Our Journal</h2>
                <a href="#" class="text-red-500 font-medium hover:underline">All Articles</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Journal Card 1 -->
                <div class="journal-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1556911261-6bd341186b2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Cooking techniques" class="w-full h-56 object-cover">
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded">Cooking Tips</span>
                            <span class="text-xs text-gray-500 ml-auto">March 1, 2025</span>
                        </div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">10 Essential Cooking Techniques Every Home Chef Should Master</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Learn the fundamental techniques that will elevate your cooking and help you prepare restaurant-quality meals at home.</p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Author" class="w-8 h-8 rounded-full object-cover border-2 border-white">
                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-900">Emma Gordon</p>
                                <p class="text-xs text-gray-500">Head Chef</p>
                            </div>
                            <a href="#" class="ml-auto text-red-500 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Journal Card 2 -->
                <div class="journal-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1505576399279-565b52d4ac71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Seasonal fruits" class="w-full h-56 object-cover">
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded">Ingredients</span>
                            <span class="text-xs text-gray-500 ml-auto">February 25, 2025</span>
                        </div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Seasonal Spring Ingredients To Add To Your Pantry Now</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Discover the freshest spring ingredients that will bring vibrant flavors and colors to your seasonal cooking.</p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Author" class="w-8 h-8 rounded-full object-cover border-2 border-white">
                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-900">David Chen</p>
                                <p class="text-xs text-gray-500">Food Writer</p>
                            </div>
                            <a href="#" class="ml-auto text-red-500 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Journal Card 3 -->
                <div class="journal-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1592417817098-8fd3d9eb14a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Kitchen tools" class="w-full h-56 object-cover">
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded">Equipment</span>
                            <span class="text-xs text-gray-500 ml-auto">February 18, 2025</span>
                        </div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">The 5 Kitchen Gadgets That Are Actually Worth The Investment</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Skip the unnecessary gadgets and focus on these truly useful tools that will make cooking easier and more enjoyable.</p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Author" class="w-8 h-8 rounded-full object-cover border-2 border-white">
                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-900">Olivia Martinez</p>
                                <p class="text-xs text-gray-500">Kitchen Expert</p>
                            </div>
                            <a href="#" class="ml-auto text-red-500 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer could go here -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-red-500 rounded text-white p-1.5 mr-2">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <span class="text-xl font-bold">Platea</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Discover delicious recipes from around the world. Cook with confidence.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Recipes</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Submit Recipe</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Breakfast</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Lunch</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Dinner</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Desserts</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Vegetarian</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter and get the latest recipes delivered to your inbox.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email address" class="p-2 rounded-l text-gray-800 w-full focus:outline-none">
                        <button class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-r transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2025 Platea. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </div>
    </footer>
</body>
</html>