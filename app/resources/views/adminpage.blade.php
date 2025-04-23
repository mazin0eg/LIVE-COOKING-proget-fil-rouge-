<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Platea - Admin Dashboard</title>
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
 
          
            .toast {
                animation: slideIn 0.3s ease-in-out;
            }
            
            @keyframes slideIn {
                from {
                    transform: translateY(-100%);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
    
            /* Dropdown Menu */
            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                top: 100%;
                min-width: 200px;
            }
    
            .dropdown:hover .dropdown-content {
                display: block;
            }
       
    </style>
</head>
<body class="bg-gray-50">
    @if(session('success'))
    <div class="fixed top-4 right-4 z-50 toast bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            document.querySelector('.toast').classList.add('hidden');
        }, 3000);
    </script>
    @endif

  
        <!-- Toast Notification -->
        <div id="toast" class="fixed top-4 right-4 z-50 hidden toast">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span id="toastMessage">Action completed successfully!</span>
                </div>
            </div>
        </div>
    
        <!-- Navigation Bar -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">Platea Admin</h1>
                    </div>
                    
                   
    
                    <!-- User Menu -->
                    <div class="relative dropdown">
                        <button class="flex items-center space-x-3 hover:bg-gray-50 px-3 py-2 rounded-lg">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" class="h-8 w-8 rounded-full object-cover">
                            <div class="text-left">
                                <p class="text-sm font-medium text-gray-700">mazin0eg</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </button>
                        <div class="dropdown-content bg-white rounded-lg shadow-lg py-2 border mt-1">
                            <a href="#profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            <a href="#settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <hr class="my-2 border-gray-200">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    
        <!-- Main Navigation Pills -->
        <div class="bg-white border-b border-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex overflow-x-auto py-4 space-x-4 no-scrollbar">
                    <button onclick="switchTab('dashboard')" class="tab-btn active-tab bg-red-500 text-white px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </button>
                    <button onclick="switchTab('categories')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-tags mr-2"></i> Categories
                    </button>
                    <button onclick="switchTab('recipes')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-utensils mr-2"></i> Recipes
                    </button>
                    <button onclick="switchTab('ingredients')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-carrot mr-2"></i> Ingredients
                    </button>
                    <button onclick="switchTab('chefs')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-user-chef mr-2"></i> Chefs
                    </button>
                    <button onclick="switchTab('users')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-users mr-2"></i> Users
                    </button>
                    <button onclick="switchTab('reports')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-chart-bar mr-2"></i> Reports
                    </button>
                    <button onclick="switchTab('settings')" class="tab-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-full text-sm whitespace-nowrap transition-colors">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Breadcrumb -->
        <div class="bg-gray-50 border-b border-gray-200">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center text-sm text-gray-600">
                    <a href="#" class="hover:text-gray-900">Dashboard</a>
                    <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                    <span class="text-gray-900" id="currentSection">Overview</span>
                </div>
            </div>
        </div>
    
        
    
        <script>
            // Update current time
            function updateTime() {
                const now = new Date();
                const formatted = now.toISOString().replace('T', ' ').substring(0, 19) + ' UTC';
                document.getElementById('currentTime').textContent = formatted;
            }
            setInterval(updateTime, 1000);

            // Show toast message
            function showToast(message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');
                toastMessage.textContent = message;
                
                // Set color based on type
                const toastDiv = toast.firstElementChild;
                toastDiv.className = toastDiv.className.replace(/bg-\w+-500/, type === 'success' ? 'bg-green-500' : 'bg-red-500');
                
                toast.classList.remove('hidden');
                setTimeout(() => toast.classList.add('hidden'), 3000);
            }
            
            // Confirm recipe deletion
            function confirmDeleteRecipe(recipeId) {
                if (confirm('Are you sure you want to delete this recipe? This action cannot be undone.')) {
                    // Create a form and submit it to delete the recipe
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/recipe/${recipeId}`;
                    form.style.display = 'none';
                    
                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfToken);
                    
                    // Add method field for DELETE
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            }

            // Tab switching functionality
            function switchTab(tabName) {
                // Update active tab
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    if (btn.textContent.toLowerCase().includes(tabName.toLowerCase())) {
                        btn.classList.add('bg-red-500', 'text-white');
                        btn.classList.remove('bg-gray-100', 'text-gray-700');
                    } else {
                        btn.classList.remove('bg-red-500', 'text-white');
                        btn.classList.add('bg-gray-100', 'text-gray-700');
                    }
                });
    
                // Update breadcrumb
                document.getElementById('currentSection').textContent = 
                    tabName.charAt(0).toUpperCase() + tabName.slice(1);
    
                // Load content (example)
                loadContent(tabName);
            }
    
            // Load content based on selected tab
            function loadContent(tabName) {
                const contentDiv = document.getElementById('dashboardContent');
                
                // Example content loading
                switch(tabName) {
                    case 'dashboard':
                        contentDiv.innerHTML = `
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                                <!-- Statistics Cards -->
                            </div>
                        `;
                        break;
                    case 'categories':
                        contentDiv.innerHTML = `
                            <!-- Categories Content -->
                        `;
                        break;
                    // Add cases for other tabs
                }
            }
    
            // Initialize dashboard
            document.addEventListener('DOMContentLoaded', () => {
                updateTime();
                loadContent('dashboard');
            });
        </script>
 

  

    <!-- Stats Overview -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="recipe-card bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full">
                            <i class="fas fa-utensils text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Total Recipes</h3>
                            <p class="text-3xl font-bold">{{ $recipeCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="recipe-card bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-tags text-blue-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Categories</p>
                            <h3 class="text-2xl font-bold text-gray-900">12</h3>
                        </div>
                    </div>
                </div>
                <div class="recipe-card bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-users text-green-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Active Chefs</h3>
                            <p class="text-3xl font-bold">{{ $chefCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="recipe-card bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <i class="fas fa-carrot text-yellow-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Ingredients</p>
                            <h3 class="text-2xl font-bold text-gray-900">890</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Recipes Management -->
            <div class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Recent Recipes</h2>
                    <div class="flex items-center space-x-4">
                        <form id="recipeFilterForm" class="flex items-center space-x-3">
                            <div class="relative">
                                <select id="chefFilter" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-sm">
                                    <option value="">All Chefs</option>
                                    @foreach($recipes->pluck('user')->unique() as $chef)
                                        @if($chef)
                                            <option value="{{ $chef->id }}">{{ $chef->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-user-chef text-gray-400"></i>
                                </div>
                            </div>
                            <button type="button" id="clearFilters" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times-circle"></i> Clear
                            </button>
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6" id="recipeContainer">
                    @forelse($recipes as $recipe)
                    <!-- Recipe Card with Admin Controls -->
                    <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm" data-chef-id="{{ $recipe->user_id ?? 0 }}">
                        <div class="relative">
                            @if($recipe->image_path)
                                <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" alt="Recipe Placeholder" class="w-full h-48 object-cover">
                            @endif
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Published</div>
                            <div class="absolute top-2 right-2 flex space-x-2">
                                <a href="{{ route('recipe.edit', $recipe->id) }}" class="bg-white/90 backdrop-blur-sm rounded-full p-2 text-blue-500 shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDeleteRecipe({{ $recipe->id }})" class="bg-white/90 backdrop-blur-sm rounded-full p-2 text-red-500 shadow-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                            <div class="flex items-center mt-3 pt-3 border-t">
                                @if($recipe->user)
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($recipe->user->name) }}&background=random" alt="Chef" class="w-6 h-6 rounded-full mr-2">
                                    <span class="text-xs text-gray-500">By {{ $recipe->user->name }}</span>
                                @else
                                    <span class="text-xs text-gray-500">By Unknown Chef</span>
                                @endif
                                <span class="ml-auto text-xs text-gray-500">Added {{ $recipe->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-4 p-8 text-center">
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <i class="fas fa-utensils text-gray-300 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Recipes Found</h3>
                            <p class="text-gray-500 mb-4">There are no recipes in the system yet.</p>
                            <a href="{{ route('recipe.create') }}" class="inline-block bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 transition-colors">
                                <i class="fas fa-plus mr-2"></i> Add First Recipe
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Category Management -->
<div class="bg-white rounded-lg shadow-sm mb-6">
    <div class="p-6 border-b border-gray-100">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Categories</h2>
            <button onclick="openCategoryModal()" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition-colors">
                Add Category
            </button>
        </div>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left bg-gray-50">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Recipes</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                @foreach ( $categories as $categorie  )
                
               
               
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$categorie->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">45</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <form action="{{ route('delete.category', $categorie->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Add New Category</h3>
            <button onclick="closeCategoryModal()" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="categoryForm" action="{{route('addcategories')}}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    placeholder="Enter category name"
                    required
                >
            </div>
        
            <div class="flex space-x-3 pt-4">
                <button 
                    type="button"
                    onclick="closeCategoryModal()"
                    class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="flex-1 px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors"
                >
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCategoryModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('categoryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCategoryModal();
        }
    });

</script>

           <!-- Chef Management section will be here -->

<script>
    // Recipe filtering by chef
    document.addEventListener('DOMContentLoaded', function() {
        const chefFilter = document.getElementById('chefFilter');
        const clearFilters = document.getElementById('clearFilters');
        const recipeCards = document.querySelectorAll('#recipeContainer .recipe-card');
        
        // Filter recipes by chef
        chefFilter.addEventListener('change', function() {
            const selectedChefId = this.value;
            
            recipeCards.forEach(card => {
                const cardChefId = card.getAttribute('data-chef-id');
                
                if (!selectedChefId || cardChefId === selectedChefId) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show empty state if no recipes match the filter
            checkEmptyState();
        });
        
        // Clear all filters
        clearFilters.addEventListener('click', function() {
            chefFilter.value = '';
            
            recipeCards.forEach(card => {
                card.style.display = 'block';
            });
            
            // Hide empty state
            document.getElementById('emptyRecipeState')?.classList.add('hidden');
        });
        
        // Check if there are no visible recipes and show empty state
        function checkEmptyState() {
            let visibleRecipes = 0;
            
            recipeCards.forEach(card => {
                if (card.style.display !== 'none') {
                    visibleRecipes++;
                }
            });
            
            // Get or create empty state element
            let emptyState = document.getElementById('emptyRecipeState');
            
            if (!emptyState) {
                emptyState = document.createElement('div');
                emptyState.id = 'emptyRecipeState';
                emptyState.className = 'col-span-4 p-8 text-center hidden';
                emptyState.innerHTML = `
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <i class="fas fa-filter text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Recipes Match Your Filter</h3>
                        <p class="text-gray-500 mb-4">Try changing your filter criteria or clear filters to see all recipes.</p>
                    </div>
                `;
                document.getElementById('recipeContainer').appendChild(emptyState);
            }
            
            if (visibleRecipes === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    });
</script>

         <!-- Chef Validation -->
            <div class="bg-white rounded-lg shadow-sm mb-12">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold">Chef Applications</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($chefApplications->count() > 0)
                            @foreach($chefApplications as $application)
                                <!-- Chef Application Card -->
                                <div class="recipe-card bg-white rounded-lg border p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="https://ui-avatars.com/api/?name={{ $application->first_name }}+{{ $application->last_name }}&background=random" alt="Chef" class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <h3 class="font-bold text-gray-900">{{ $application->first_name }} {{ $application->last_name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $application->speciality ?? 'Chef Applicant' }}</p>
                                            @if($application->user_id)
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Registered User</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="space-y-2 mb-4">
                                        <p class="text-sm"><span class="font-medium">Experience:</span> {{ $application->experience ?? 'Not specified' }}</p>
                                        <p class="text-sm"><span class="font-medium">Email:</span> {{ $application->email }}</p>
                                        <p class="text-sm"><span class="font-medium">Message:</span> {{ Str::limit($application->message, 100) }}</p>
                                        <p class="text-sm"><span class="font-medium">Status:</span> 
                                            @if($application->status == 'pending')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending Review</span>
                                            @elseif($application->status == 'approved')
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Approved</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Rejected</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if($application->status == 'pending')
                                        <div class="flex space-x-2">
                                            <form action="{{ route('chef.approve', $application->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('chef.reject', $application->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-3 text-center py-8">
                                <p class="text-gray-500">No chef applications found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            
        </div>
        </div>
    </section>


    
</body>
</html>
