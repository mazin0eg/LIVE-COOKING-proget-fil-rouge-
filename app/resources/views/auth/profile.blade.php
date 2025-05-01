<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNow - Profile</title>
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
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" 
                             alt="{{ $user->first_name }}" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $user->first_name }}+{{ $user->last_name }}&background=random" 
                             alt="{{ $user->first_name }}" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @endif
                    <a href="{{ route('profile.edit') }}" class="absolute bottom-0 right-0 bg-red-500 text-white rounded-full p-2 shadow-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-camera"></i>
                    </a>
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h1>
                            <p class="text-gray-500">Member since {{ $user->created_at->format('F Y') }}</p>
                            <div class="mt-2">
                                @if($user->role === 'chef')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-utensils mr-1"></i> Chef
                                    </span>
                                @elseif($user->role === 'admin')
                                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-crown mr-1"></i> Admin
                                    </span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-user mr-1"></i> Cooker
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('profile.edit') }}" class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 transition-colors">
                                Edit Profile
                            </a>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-center md:justify-start mt-6">
                        @if($user->role === 'chef')
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ App\Models\Recipe::where('user_id', $user->id)->count() }}</div>
                                <div class="text-sm text-gray-500">Recipes Created</div>
                            </div>
                        @else
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ App\Models\CookedRecipe::where('user_id', $user->id)->where('completed_at', '!=', null)->count() }}</div>
                                <div class="text-sm text-gray-500">Recipes Cooked</div>
                            </div>
                        @endif
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
                    @if($user->role === 'chef')
                        My Created Recipes
                    @else
                        My Cooked Recipes
                    @endif
                </button>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @if($recipes->count() > 0)
                    @if($recipesType === 'created')
                        <!-- Chef's Created Recipes -->
                        @foreach($recipes as $recipe)
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
                                <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                                    @if($recipe->category)
                                        <span>{{ $recipe->category->name }}</span>
                                    @else
                                        <span>Uncategorized</span>
                                    @endif
                                </div>
                                <div class="absolute top-2 right-2 flex space-x-2">
                                    <a href="{{ route('recipe.edit', $recipe) }}" class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm hover:bg-white transition-colors">
                                        <i class="fas fa-edit text-gray-600"></i>
                                    </a>
                                    <form action="{{ route('recipe.delete', $recipe->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm hover:bg-white transition-colors">
                                            <i class="fas fa-trash text-red-500"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-2">{{ $recipe->title }}</h3>
                                <div class="flex items-center text-xs text-gray-500 mb-2">
                                    <span class="flex items-center mr-3">
                                        <i class="far fa-clock mr-1"></i> {{ $recipe->prep_time + $recipe->cook_time }} mins
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-utensils mr-1"></i> {{ $recipe->servings }} servings
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-xs text-gray-500">Posted {{ $recipe->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Cooker's Cooked Recipes -->
                        @foreach($recipes as $cookedRecipe)
                        <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                            <div class="relative">
                                @if($cookedRecipe->recipe->image_path)
                                <img src="{{ asset('storage/' . $cookedRecipe->recipe->image_path) }}" 
                                     alt="{{ $cookedRecipe->recipe->title }}" 
                                     class="w-full h-48 object-cover">
                                @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                                     alt="{{ $cookedRecipe->recipe->title }}" 
                                     class="w-full h-48 object-cover">
                                @endif
                                <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                                    @if($cookedRecipe->recipe->category)
                                        <span>{{ $cookedRecipe->recipe->category->name }}</span>
                                    @else
                                        <span>Uncategorized</span>
                                    @endif
                                </div>
                                <div class="absolute top-2 right-2 flex space-x-2">
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i> Cooked
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-2">{{ $cookedRecipe->recipe->title }}</h3>
                                <div class="flex items-center text-xs text-gray-500 mb-2">
                                    <span class="flex items-center mr-3">
                                        <i class="far fa-clock mr-1"></i> {{ gmdate('H:i:s', $cookedRecipe->cooking_time) }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-check-square mr-1"></i> {{ $cookedRecipe->completed_steps }} steps
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-xs text-gray-500">Cooked {{ $cookedRecipe->completed_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <a href="{{ route('recipes.show', $cookedRecipe->recipe) }}" class="text-red-500 hover:underline text-sm">
                                            <i class="fas fa-external-link-alt mr-1"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                @else
                    <!-- No Recipes Message -->
                    <div class="col-span-full p-8 text-center">
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <i class="fas fa-utensils text-gray-300 text-5xl mb-4"></i>
                            @if($recipesType === 'created')
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Recipes Created Yet</h3>
                                <p class="text-gray-500 mb-4">Start creating your own recipes to share with the community!</p>
                                <a href="{{ route('recipe.create') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-plus mr-2"></i> Create Recipe
                                </a>
                            @else
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Recipes Cooked Yet</h3>
                                <p class="text-gray-500 mb-4">Start cooking recipes and track your progress!</p>
                                <a href="{{ route('recipes.index') }}" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-search mr-2"></i> Find Recipes
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            <div class="text-center mt-8">
                {{ $recipes->links() }}
            </div>
        </div>
    </section>

    <!-- Create Recipe Button (Only for Chefs) -->
    @if(Auth::user()->role === 'chef')
    <a href="{{ route('recipe.create') }}" class="fixed bottom-6 right-6 bg-red-500 text-white rounded-full p-4 shadow-lg hover:bg-red-600 transition-colors">
        <i class="fas fa-plus text-xl"></i>
    </a>
    @endif

    <!-- Footer could go here -->
    <x-footer />
</body>
</html>