

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    
                    <!-- Current Time -->
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-sm text-gray-500">
                            <i class="far fa-clock mr-2"></i>
                            <span id="currentTime">2025-03-27 10:56:23 UTC</span>
                        </div>
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
                            <a href="#logout" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
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
                            <p class="text-sm text-gray-500">Total Recipes</p>
                            <h3 class="text-2xl font-bold text-gray-900">245</h3>
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
                            <p class="text-sm text-gray-500">Active Chefs</p>
                            <h3 class="text-2xl font-bold text-gray-900">58</h3>
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
                    
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Recipe Card with Admin Controls -->
                    <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" alt="Recipe" class="w-full h-48 object-cover">
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Published</div>
                            <div class="absolute top-2 right-2 flex space-x-2">
                                <button class="bg-white/90 backdrop-blur-sm rounded-full p-2 text-blue-500 shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="bg-white/90 backdrop-blur-sm rounded-full p-2 text-red-500 shadow-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                            <div class="flex items-center mt-3 pt-3 border-t">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Chef" class="w-6 h-6 rounded-full mr-2">
                                <span class="text-xs text-gray-500">By John Cook</span>
                                <span class="ml-auto text-xs text-gray-500">Added 2 days ago</span>
                            </div>
                        </div>
                    </div>
                    <!-- Add more recipe cards here -->
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
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Breakfast</td>
                        <td class="px-6 py-4 whitespace-nowrap">45</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-blue-500 hover:text-blue-700 mr-3">Edit</button>
                            <button class="text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                </tbody>
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
        
        <form id="categoryForm" class="space-y-4">
            <div>
                <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input 
                    type="text" 
                    id="categoryName" 
                    name="categoryName"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    placeholder="Enter category name"
                    required
                >
            </div>

            <div>
                <label for="categoryDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea 
                    id="categoryDescription" 
                    name="categoryDescription"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    placeholder="Enter category description"
                ></textarea>
            </div>

            <div>
                <label for="categoryIcon" class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                <div class="flex items-center space-x-2">
                    <select 
                        id="categoryIcon" 
                        name="categoryIcon"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    >
                        <option value="utensils">🍽️ Utensils</option>
                        <option value="coffee">☕ Coffee</option>
                        <option value="pizza">🍕 Pizza</option>
                        <option value="salad">🥗 Salad</option>
                        <option value="cake">🍰 Cake</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        class="form-checkbox h-4 w-4 text-red-500 rounded focus:ring-2 focus:ring-red-500"
                        name="isActive"
                        checked
                    >
                    <span class="ml-2 text-sm text-gray-700">Active Category</span>
                </label>
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

    // Handle form submission
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = {
            name: document.getElementById('categoryName').value,
            description: document.getElementById('categoryDescription').value,
            icon: document.getElementById('categoryIcon').value,
            isActive: document.querySelector('input[name="isActive"]').checked
        };

        // Here you would typically send the data to your backend
        console.log('Category Data:', formData);

        // Close the modal
        closeCategoryModal();

        // Reset form
        this.reset();
    });
</script>

            <!-- Chef Validation -->
            <div class="bg-white rounded-lg shadow-sm mb-12">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold">Chef Applications</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Chef Application Card -->
                        <div class="recipe-card bg-white rounded-lg border p-6">
                            <div class="flex items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Chef" class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h3 class="font-bold text-gray-900">James Wilson</h3>
                                    <p class="text-sm text-gray-500">Italian Cuisine Specialist</p>
                                </div>
                            </div>
                            <div class="space-y-2 mb-4">
                                <p class="text-sm"><span class="font-medium">Experience:</span> 5 years</p>
                                <p class="text-sm"><span class="font-medium">Location:</span> New York, USA</p>
                                <p class="text-sm"><span class="font-medium">Status:</span> 
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending Review</span>
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
                                    Approve
                                </button>
                                <button class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm">
                                    Reject
                                </button>
                            </div>
                        </div>
                        <!-- Add more chef application cards -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>