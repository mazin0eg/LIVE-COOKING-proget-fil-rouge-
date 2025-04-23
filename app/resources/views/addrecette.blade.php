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

        .ingredient-item, .step-item, .equipment-item {
            transition: all 0.3s ease;
        }

        .ingredient-item:hover, .step-item:hover, .equipment-item:hover {
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
            <form class="space-y-8" action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! There were some problems with your submission.</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif
                <!-- Basic Info Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Basic Information</h2>
                    
                    <!-- Recipe Title -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Recipe Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Enter recipe title" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent h-32"
                                  placeholder="Describe your recipe" required></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recipe Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Prep Time -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prep Time <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <input type="number" name="prep_time"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="0" required>
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">mins</span>
                            </div>
                            @error('prep_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cuisine -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Cuisine <span class="text-red-500">*</span></label>
                            <input type="text" name="cuisine" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="e.g., Italian, French, Mexican" required>
                            @error('cuisine')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cook Time -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Cook Time <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <input type="number" name="cook_time"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="0" required>
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-600">mins</span>
                            </div>
                            @error('cook_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Servings -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Servings <span class="text-red-500">*</span></label>
                            <input type="number" name="servings"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="4" required>
                            @error('servings')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Recipe Media -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Recipe Photo <span class="text-red-500">*</span></h2>
                    
                    <!-- Main Photo Upload -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Main Photo</label>
                        <div class="flex items-center space-x-4">
                            <!-- Upload Area -->
                            <div class="relative" id="main-image-upload-container">
                                <input type="file" name="image" accept="image/*" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    onchange="previewMainImage(this)" required>
                                <div class="w-48 h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors">
                                    <div class="text-center">
                                        <i class="fas fa-camera text-gray-400 text-3xl mb-2"></i>
                                        <p class="text-sm text-gray-500">Upload Main Image</p>
                                        <p class="text-xs text-gray-400 mt-1">Click or drag & drop</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Preview Container -->
                            <div class="hidden w-48 h-48 relative rounded-lg overflow-hidden" id="main-image-preview">
                                <img src="" alt="Recipe preview" class="w-full h-full object-cover">
                                <button type="button" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600"
                                    onclick="removeMainImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Ingredients <span class="text-red-500">*</span></h2>
                    
                    <div class="space-y-4 mb-6" id="ingredients-container">
                        <!-- Ingredient Items -->
                        <div class="ingredient-item flex items-center space-x-4 p-3 rounded-lg">
                            <input type="text" name="ingredients[]" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Ingredient name" required>
                            <input type="text" name="quantities[]" 
                                   class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Amount" required>
                            <select name="units[]" class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                                <option>g</option>
                                <option>ml</option>
                                <option>cups</option>
                                <option>tbsp</option>
                                <option>tsp</option>
                            </select>
                            <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeIngredient(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" 
                            onclick="addNewIngredient()"
                            class="flex items-center text-red-500 hover:text-red-600 font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Ingredient
                    </button>
                </div>

                <!-- Instructions -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Instructions <span class="text-red-500">*</span></h2>
                    
                    <div class="space-y-4 mb-6" id="steps-container">
                        <!-- Step Template -->
                        <div class="step-item bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <!-- Step Number -->
                                <div class="flex-shrink-0 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">
                                    1
                                </div>
                                
                                <div class="flex-grow space-y-4">
                                    <!-- Step Description -->
                                    <textarea name="steps[]" rows="3" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                        placeholder="Describe this step..." required></textarea>
                                    
                                    <!-- Image Upload -->
                                    <div class="step-image-upload">
                                        <label class="block text-gray-700 text-sm font-medium mb-2">Step Image</label>
                                        <div class="flex items-center space-x-4">
                                            <div class="relative">
                                                <input type="file" name="step_images[]" accept="image/*" 
                                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                    onchange="previewStepImage(this)">
                                                <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="text-center">
                                                        <i class="fas fa-camera text-gray-400 text-xl mb-2"></i>
                                                        <p class="text-sm text-gray-500">Upload Image</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Image Preview -->
                                            <div class="hidden w-32 h-32 relative rounded-lg overflow-hidden preview-container">
                                                <img src="" alt="Step preview" class="w-full h-full object-cover">
                                                <button type="button" 
                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600"
                                                    onclick="removeStepImage(this)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Remove Step Button -->
                                <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeStep(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" 
                            onclick="addNewStep()"
                            class="flex items-center text-red-500 hover:text-red-600 font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Step
                    </button>
                </div>

                <!-- Kitchen Equipment Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Kitchen Equipment <span class="text-red-500">*</span></h2>
                    
                    <div class="space-y-4 mb-6" id="equipment-container">
                        <!-- Equipment Item Template -->
                        <div class="equipment-item flex items-center space-x-4 p-3 rounded-lg bg-gray-50">
                            <input type="text" name="equipment[]" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="e.g., Mixing Bowl, Blender, Oven, etc." required>
                            <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeEquipment(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" 
                            onclick="addNewEquipment()"
                            class="flex items-center text-red-500 hover:text-red-600 font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Add Equipment
                    </button>
                </div>

                <!-- Additional Info -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Additional Information</h2>
                    
                    <!-- Category & Cuisine -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Category -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Category <span class="text-red-500">*</span></label>
                            <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tags</label>
                            <input type="text" name="tags" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Add tags separated by commas">
                            @error('tags')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Difficulty Level -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Difficulty Level <span class="text-red-500">*</span></label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="difficulty" value="easy" class="text-red-500 focus:ring-red-500" required>
                                <span class="ml-2">Easy</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="difficulty" value="medium" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Medium</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="difficulty" value="hard" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Hard</span>
                            </label>
                        </div>
                        @error('difficulty')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                        Save as Draft
                    </button>
                    <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-600 transition-colors">
                        Publish Recipe
                    </button>
                </div>
                
                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif
            </form>
        </div>
    </div>

     <!-- Footer could go here -->
     <x-footer />
    <script>
        function addNewStep() {
            const container = document.getElementById('steps-container');
            const stepItems = container.getElementsByClassName('step-item');
            const newStep = stepItems[0].cloneNode(true);
            
            // Update step number
            const stepNumber = stepItems.length + 1;
            newStep.querySelector('.bg-red-500').textContent = stepNumber;
            
            // Clear inputs
            newStep.querySelector('textarea').value = '';
            const imageUpload = newStep.querySelector('input[type="file"]');
            imageUpload.value = '';
            
            // Reset preview
            const previewContainer = newStep.querySelector('.preview-container');
            previewContainer.classList.add('hidden');
            const uploadContainer = newStep.querySelector('.border-dashed').parentElement;
            uploadContainer.classList.remove('hidden');
            
            container.appendChild(newStep);
        }

        function removeStep(button) {
            const stepsContainer = document.getElementById('steps-container');
            const stepItems = stepsContainer.getElementsByClassName('step-item');
            
            if (stepItems.length > 1) {
                const stepToRemove = button.closest('.step-item');
                stepToRemove.remove();
                
                // Update remaining step numbers
                Array.from(stepItems).forEach((item, index) => {
                    item.querySelector('.bg-red-500').textContent = index + 1;
                });
            }
        }

        function previewStepImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const stepItem = input.closest('.step-item');
                
                reader.onload = function(e) {
                    const previewContainer = stepItem.querySelector('.preview-container');
                    const uploadContainer = input.closest('.relative');
                    
                    // Set image source
                    previewContainer.querySelector('img').src = e.target.result;
                    
                    // Show preview, hide upload
                    previewContainer.classList.remove('hidden');
                    uploadContainer.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeStepImage(button) {
            const stepItem = button.closest('.step-item');
            const previewContainer = stepItem.querySelector('.preview-container');
            const uploadContainer = stepItem.querySelector('.relative');
            const fileInput = stepItem.querySelector('input[type="file"]');
            
            previewContainer.classList.add('hidden');
            uploadContainer.classList.remove('hidden');
            fileInput.value = '';
        }

        // Main image handling functions
        function previewMainImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('main-image-preview');
                    const uploadContainer = document.getElementById('main-image-upload-container');
                    
                    // Set image source
                    previewContainer.querySelector('img').src = e.target.result;
                    
                    // Show preview, hide upload
                    previewContainer.classList.remove('hidden');
                    uploadContainer.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeMainImage() {
            const previewContainer = document.getElementById('main-image-preview');
            const uploadContainer = document.getElementById('main-image-upload-container');
            const fileInput = uploadContainer.querySelector('input[type="file"]');
            
            // Clear file input
            fileInput.value = '';
            
            // Hide preview, show upload
            previewContainer.classList.add('hidden');
            uploadContainer.classList.remove('hidden');
        }

        // Equipment handling functions
        function addNewEquipment() {
            const container = document.getElementById('equipment-container');
            const equipmentItems = container.getElementsByClassName('equipment-item');
            const newEquipment = equipmentItems[0].cloneNode(true);
            
            // Clear input
            newEquipment.querySelector('input').value = '';
            
            container.appendChild(newEquipment);
        }

        function removeEquipment(button) {
            const equipmentContainer = document.getElementById('equipment-container');
            const equipmentItems = equipmentContainer.getElementsByClassName('equipment-item');
            
            if (equipmentItems.length > 1) {
                const equipmentToRemove = button.closest('.equipment-item');
                equipmentToRemove.remove();
            } else {
                // If it's the last one, just clear the input
                const input = button.closest('.equipment-item').querySelector('input');
                input.value = '';
            }
        }

        // Ingredient handling functions
        function addNewIngredient() {
            const container = document.getElementById('ingredients-container');
            const ingredientItems = container.getElementsByClassName('ingredient-item');
            const newIngredient = ingredientItems[0].cloneNode(true);
            
            // Clear inputs
            const inputs = newIngredient.querySelectorAll('input');
            inputs.forEach(input => input.value = '');
            
            container.appendChild(newIngredient);
        }

        function removeIngredient(button) {
            const ingredientsContainer = document.getElementById('ingredients-container');
            const ingredientItems = ingredientsContainer.getElementsByClassName('ingredient-item');
            
            if (ingredientItems.length > 1) {
                const ingredientToRemove = button.closest('.ingredient-item');
                ingredientToRemove.remove();
            } else {
                // If it's the last one, just clear the inputs
                const inputs = button.closest('.ingredient-item').querySelectorAll('input');
                inputs.forEach(input => input.value = '');
            }
        }
    </script>
</body>
</html>