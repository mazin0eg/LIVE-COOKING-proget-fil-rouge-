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
            {{ $recipe->cuisine ?? ($recipe->categories->first() ? $recipe->categories->first()->name : 'Uncategorized') }}
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
                    <span class="text-xs text-gray-500">Made by {{ $recipe->user ? $recipe->user->first_name . ' ' . $recipe->user->last_name : 'Unknown Chef' }}</span>
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
