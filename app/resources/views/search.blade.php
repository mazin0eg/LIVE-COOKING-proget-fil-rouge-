<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNow - Recipe Search</title>
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
    </style>
</head>
<body class="bg-gray-50">
     <!-- Navigation Bar -->
     <x-navbar />

    <!-- Search Hero Section -->
    <section class="relative h-[40vh] bg-gray-900">
        <img src="https://images.unsplash.com/photo-1495521821757-a1efb6729352" 
             alt="Cooking Background" 
             class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-full max-w-4xl px-4">
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center mb-8">Find Your Perfect Recipe</h1>
                <div class="relative">
                    <input type="text" 
                           id="recipe-search-input"
                           placeholder="Search for recipes, ingredients, or cuisines..." 
                           class="w-full px-6 py-4 rounded-full text-lg focus:outline-none focus:ring-2 focus:ring-red-500 shadow-lg">
                    <button id="recipe-search-button" class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-red-500 text-white p-3 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-8 bg-white border-b">
        <div class="container mx-auto px-4">
            <div id="recipe-filters" class="flex flex-wrap gap-4">
                <!-- Cuisine Filter -->
                <div class="relative">
                    <select data-filter-type="cuisine" class="appearance-none bg-gray-100 px-4 py-2 pr-8 rounded-full text-gray-700 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="all" {{ !isset($cuisine) ? 'selected' : '' }}>All Cuisines</option>
                        <option value="italian" {{ isset($cuisine) && strtolower($cuisine) == 'italian' ? 'selected' : '' }}>Italian</option>
                        <option value="japanese" {{ isset($cuisine) && strtolower($cuisine) == 'japanese' ? 'selected' : '' }}>Japanese</option>
                        <option value="mexican" {{ isset($cuisine) && strtolower($cuisine) == 'mexican' ? 'selected' : '' }}>Mexican</option>
                        <option value="indian" {{ isset($cuisine) && strtolower($cuisine) == 'indian' ? 'selected' : '' }}>Indian</option>
                        <option value="chinese" {{ isset($cuisine) && strtolower($cuisine) == 'chinese' ? 'selected' : '' }}>Chinese</option>
                        <option value="french" {{ isset($cuisine) && strtolower($cuisine) == 'french' ? 'selected' : '' }}>French</option>
                        <option value="moroccan" {{ isset($cuisine) && strtolower($cuisine) == 'moroccan' ? 'selected' : '' }}>Moroccan</option>
                        <option value="arab" {{ isset($cuisine) && strtolower($cuisine) == 'arab' ? 'selected' : '' }}>Arab</option>
                        <option value="egyptian" {{ isset($cuisine) && strtolower($cuisine) == 'egyptian' ? 'selected' : '' }}>Egyptian</option>
                        <option value="nigerian" {{ isset($cuisine) && strtolower($cuisine) == 'nigerian' ? 'selected' : '' }}>Nigerian</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <!-- Meal Type Filter -->
                <div class="relative">
                    <select data-filter-type="meal" class="appearance-none bg-gray-100 px-4 py-2 pr-8 rounded-full text-gray-700 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="all">All Meals</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="dessert">Dessert</option>
                        <option value="snacks">Snacks</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <!-- Diet Filter -->
                <div class="relative">
                    <select data-filter-type="diet" class="appearance-none bg-gray-100 px-4 py-2 pr-8 rounded-full text-gray-700 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="all">All Diets</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="vegan">Vegan</option>
                        <option value="gluten-free">Gluten-Free</option>
                        <option value="keto">Keto</option>
                        <option value="paleo">Paleo</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <!-- Cooking Time Filter -->
                <div class="relative">
                    <select data-filter-type="time" class="appearance-none bg-gray-100 px-4 py-2 pr-8 rounded-full text-gray-700 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="all">Any Time</option>
                        <option value="15">Under 15 mins</option>
                        <option value="30">15-30 mins</option>
                        <option value="60">30-60 mins</option>
                        <option value="60+">Over 60 mins</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <!-- Results Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold results-count">{{ $recipes->total() }} Recipes Found</h2>
                <div class="relative">
                    <select class="appearance-none bg-gray-100 px-4 py-2 pr-8 rounded-full text-gray-700 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option>Most Popular</option>
                        <option>Newest</option>
                        <option>Cooking Time</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Results Grid -->
            <div id="recipe-results" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($recipes as $recipe)
                <!-- Recipe Card -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        @if($recipe->image_path)
                        <img src="{{ asset('storage/' . $recipe->image_path) }}" 
                             alt="{{ $recipe->title }}" 
                             class="w-full h-48 object-cover">
                        @else
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                             alt="{{ $recipe->title }}" 
                             class="w-full h-48 object-cover">
                        @endif
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm">
                            <i class="far fa-heart text-red-500"></i>
                        </div>
                        <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm rounded-full py-1 px-3 text-xs font-medium flex items-center shadow-sm cuisine-tag">
                            {{ $recipe->cuisine ?? ($recipe->category ? $recipe->category->name : 'Uncategorized') }}
                        </div>
                    </div>
                    <a href="{{ route('recipes.start-cooking', $recipe) }}" class="block">
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
                                    <span class="text-xs text-gray-500">Made by {{ $recipe->user->name }}</span>
                                </div>
                                <span class="text-xs text-gray-500">{{ $recipe->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="recipe-description hidden">{{ $recipe->description }}</p>
                        </div>
                    </a>
                    <div class="block bg-red-500 hover:bg-red-600 text-white text-center py-2 transition-colors">
                        <i class="fas fa-utensils mr-1"></i> Start Cooking
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-500">No recipes found</h3>
                    <p class="text-gray-400 mt-2">Try adjusting your search or filters</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $recipes->links() }}
            </div>
        </div>
    </section>
  <!-- Footer could go here -->
    <x-footer />

    <script src="{{ asset('js/search.js') }}"></script>
    
    <!-- Login Popup for unauthenticated users -->
    @guest
        <x-login-popup />
    @endguest
    
    <!-- Recipe Card Script for Login Popup -->
    <x-recipe-card-script />
</body>
</html>