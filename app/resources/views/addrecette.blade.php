<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - Add New Recipe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .drag-drop-zone {
            border: 2px dashed #E5E7EB;
            transition: all 0.3s ease;
        }
        
        .drag-drop-zone:hover {
            border-color: #EF4444;
        }

        .ingredient-item, .step-item {
            transition: all 0.3s ease;
        }

        .ingredient-item:hover, .step-item:hover {
            background-color: #F9FAFB;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
     <x-navbar />

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Recipe</h1>
                <p class="text-gray-600">Share your culinary masterpiece with the world</p>
            </div>

            <!-- Recipe Form -->
            <form class="space-y-8">
                <!-- Basic Info Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Basic Information</h2>
                    
                    <!-- Recipe Title -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Recipe Title</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Enter recipe title">
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent h-32"
                                  placeholder="Describe your recipe"></textarea>
                    </div>

                    <!-- Recipe Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Prep Time -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prep Time</label>
                            <div class="flex">
                                <input type="number" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="0">
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">mins</span>
                            </div>
                        </div>

                        <!-- Cook Time -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Cook Time</label>
                            <div class="flex">
                                <input type="number" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="0">
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">mins</span>
                            </div>
                        </div>

                        <!-- Servings -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Servings</label>
                            <input type="number" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="4">
                        </div>
                    </div>
                </div>

                <!-- Recipe Media -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Recipe Photos</h2>
                    
                    <!-- Main Photo Upload -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Main Photo</label>
                        <div class="drag-drop-zone rounded-lg p-8 text-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-2">Drag and drop your photo here or</p>
                            <button type="button" class="text-red-500 font-medium hover:text-red-600">browse files</button>
                        </div>
                    </div>

                    <!-- Additional Photos -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Additional Photos</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="drag-drop-zone rounded-lg p-4 text-center aspect-square flex items-center justify-center">
                                <i class="fas fa-plus text-gray-400"></i>
                            </div>
                            <!-- Add more photo slots as needed -->
                        </div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Ingredients</h2>
                    
                    <div class="space-y-4 mb-6">
                        <!-- Ingredient Items -->
                        <div class="ingredient-item flex items-center space-x-4 p-3 rounded-lg">
                            <input type="text" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Enter ingredient">
                            <input type="text" 
                                   class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Amount">
                            <select class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option>g</option>
                                <option>ml</option>
                                <option>cups</option>
                                <option>tbsp</option>
                                <option>tsp</option>
                            </select>
                            <button type="button" class="text-gray-400 hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" 
                            class="flex items-center text-red-500 hover:text-red-600 font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Ingredient
                    </button>
                </div>

                <!-- Instructions -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Instructions</h2>
                    
                    <div class="space-y-4 mb-6">
                        <!-- Step Items -->
                        <div class="step-item flex items-start space-x-4 p-3 rounded-lg">
                            <span class="flex-shrink-0 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">
                                1
                            </span>
                            <div class="flex-grow">
                                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                          placeholder="Describe this step" rows="3"></textarea>
                                <div class="mt-2">
                                    <button type="button" class="text-red-500 hover:text-red-600 text-sm">
                                        Add photo to this step
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="text-gray-400 hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" 
                            class="flex items-center text-red-500 hover:text-red-600 font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Step
                    </button>
                </div>

                <!-- Additional Info -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Additional Information</h2>
                    
                    <!-- Category & Cuisine -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Category</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option>Main Course</option>
                                <option>Appetizer</option>
                                <option>Dessert</option>
                                <option>Breakfast</option>
                                <option>Snack</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Cuisine</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option>Italian</option>
                                <option>Asian</option>
                                <option>Mexican</option>
                                <option>Mediterranean</option>
                                <option>American</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Tags</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Add tags separated by commas">
                    </div>

                    <!-- Difficulty -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Difficulty Level</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Easy</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Medium</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Hard</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                        Save as Draft
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        Publish Recipe
                    </button>
                </div>
            </form>
        </div>
    </div>

     <!-- Footer could go here -->
     <x-footer />
</body>
</html>