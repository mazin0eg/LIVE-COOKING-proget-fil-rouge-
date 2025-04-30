<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNow - Recipe Website</title>
    @guest
        <x-login-popup />
    @endguest
    <script src="https://cdn.tailwindcss.com"></script>
    <x-recipe-card-script />
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
    <x-navbar />

    

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
                <!-- Search Bar -->
                <div class="flex bg-white rounded-lg shadow-lg p-2">
                    <input type="text" 
                           id="recipe-search-input"
                           placeholder="Search cuisines or dishes..." 
                           class="flex-1 px-4 py-2 focus:outline-none">
                    <button id="recipe-search-button" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        Search
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

   

    <!-- Latest Recipes -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold mb-0">Latest Recipes</h2>
                
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6" id="recipe-results">
                @forelse($latestRecipes as $recipe)
                <!-- Recipe Card -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <a href="{{ route('recipes.start-cooking', $recipe) }}" class="block">
                        <div class="relative">
                            @if($recipe->image_path)
                                <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Recipe placeholder" class="w-full h-48 object-cover">
                            @endif
                            <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                4.8
                            </div>
                            <div class="absolute top-2 right-2 flex space-x-2">
                                <button class="heart-button bg-white/90 backdrop-blur-sm rounded-full p-2 text-red-500 shadow-sm hover:bg-white hover:text-red-600 transition-all transform hover:scale-110">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm">
                                <i class="fas fa-utensils mr-1.5"></i>
                                {{ $recipe->cuisine }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">{{ $recipe->title }}</h3>
                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                <span class="flex items-center mr-3">
                                    <i class="far fa-clock mr-1"></i> {{ $recipe->prep_time + $recipe->cook_time }} mins
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-user-friends mr-1"></i> {{ $recipe->servings }} servings
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    @if($recipe->user)
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($recipe->user->name) }}&background=random" alt="{{ $recipe->user->name }}" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                        <span class="text-xs text-gray-500">Made by {{ $recipe->user->name }}</span>
                                    @else
                                        <img src="https://ui-avatars.com/api/?name=Unknown&background=random" alt="Unknown Chef" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                        <span class="text-xs text-gray-500">Unknown Chef</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-500">{{ $recipe->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="block bg-red-500 hover:bg-red-600 text-white text-center py-2 transition-colors">
                        <i class="fas fa-utensils mr-1"></i> Start Cooking
                    </div>
                </div>
                @empty
                <div class="col-span-5 p-8 text-center">
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <i class="fas fa-utensils text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Recipes Found</h3>
                        <p class="text-gray-500 mb-4">There are no recipes in the system yet.</p>
                    </div>
                </div>
                @endforelse




               

                 

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
                @forelse($newRecipes as $recipe)
                <!-- New Recipe Card -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <a href="{{ route('recipes.start-cooking', $recipe) }}" class="block">
                        <div class="relative">
                            @if($recipe->image_path)
                                <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" alt="Recipe placeholder" class="w-full h-48 object-cover">
                            @endif
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">New</div>
                            <div class="absolute top-2 right-2 flex space-x-2">
                                <button class="heart-button bg-white rounded-full p-2 text-red-500 shadow-sm">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm">
                                <i class="fas fa-utensils mr-1.5"></i>
                                {{ $recipe->cuisine }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">{{ $recipe->title }}</h3>
                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                <span class="flex items-center mr-3">
                                    <i class="far fa-clock mr-1"></i> {{ $recipe->prep_time + $recipe->cook_time }} mins
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-user-friends mr-1"></i> {{ $recipe->servings }} servings
                                </span>
                            </div>
                            <div class="flex justify-between items-center mt-3 pt-3 border-t">
                                <div class="flex items-center">
                                    @if($recipe->user)
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($recipe->user->name) }}&background=random" alt="{{ $recipe->user->name }}" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                        <span class="text-xs text-gray-500">Made by {{ $recipe->user->name }}</span>
                                    @else
                                        <img src="https://ui-avatars.com/api/?name=Unknown&background=random" alt="Unknown Chef" class="w-6 h-6 rounded-full mr-2 object-cover border border-white shadow-sm">
                                        <span class="text-xs text-gray-500">Unknown Chef</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-500">{{ $recipe->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="block bg-red-500 hover:bg-red-600 text-white text-center py-2 transition-colors">
                        <i class="fas fa-utensils mr-1"></i> Start Cooking
                    </div>
                </div>
                @empty
                <div class="col-span-4 p-8 text-center">
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <i class="fas fa-utensils text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No New Recipes</h3>
                        <p class="text-gray-500 mb-4">There are no new recipes added in the last 7 days.</p>
                    </div>
                </div>
                @endforelse
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
    <x-footer />
    
    <!-- Login Popup for unauthenticated users -->
    @guest
        <x-login-popup />
    @endguest
    
    <!-- Recipe Card Script for Login Popup -->
    <x-recipe-card-script />
    <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>