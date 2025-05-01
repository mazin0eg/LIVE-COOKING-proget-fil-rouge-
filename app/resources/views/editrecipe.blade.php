<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNow - Edit Recipe</title>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Recipe</h1>
                <p class="text-gray-600">Update your recipe details</p>
            </div>

            <!-- Recipe Form -->
            <form class="space-y-8" action="{{ route('recipe.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    Please fix the following errors:
                                </p>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Basic Information</h2>
                    
                    <!-- Recipe Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Recipe Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="e.g., Homemade Margherita Pizza" value="{{ old('title', $recipe->title) }}" required>
                    </div>
                    
                    <!-- Recipe Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                  placeholder="Describe your recipe in a few sentences..." required>{{ old('description', $recipe->description) }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Prep Time -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prep Time <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <input type="number" name="prep_time" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="30" value="{{ old('prep_time', $recipe->prep_time) }}" required min="0">
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-500 flex items-center">mins</span>
                            </div>
                        </div>
                        
                        <!-- Cook Time -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Cook Time <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <input type="number" name="cook_time" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="45" value="{{ old('cook_time', $recipe->cook_time) }}" required min="0">
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-500 flex items-center">mins</span>
                            </div>
                        </div>
                        
                        <!-- Servings -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Servings <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <input type="number" name="servings" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                       placeholder="4" value="{{ old('servings', $recipe->servings) }}" required min="1">
                                <span class="bg-gray-100 px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg text-gray-500 flex items-center">people</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Difficulty -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Difficulty <span class="text-red-500">*</span></label>
                            <select name="difficulty" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="easy" {{ old('difficulty', $recipe->difficulty) == 'easy' ? 'selected' : '' }}>Easy</option>
                                <option value="medium" {{ old('difficulty', $recipe->difficulty) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="hard" {{ old('difficulty', $recipe->difficulty) == 'hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>
                        
                        <!-- Cuisine -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Cuisine <span class="text-red-500">*</span></label>
                            <select name="cuisine" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="French" {{ old('cuisine', $recipe->cuisine) == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Italian" {{ old('cuisine', $recipe->cuisine) == 'Italian' ? 'selected' : '' }}>Italian</option>
                                <option value="Japanese" {{ old('cuisine', $recipe->cuisine) == 'Japanese' ? 'selected' : '' }}>Japanese</option>
                                <option value="Moroccan" {{ old('cuisine', $recipe->cuisine) == 'Moroccan' ? 'selected' : '' }}>Moroccan</option>
                                <option value="Mexican" {{ old('cuisine', $recipe->cuisine) == 'Mexican' ? 'selected' : '' }}>Mexican</option>
                                <option value="American" {{ old('cuisine', $recipe->cuisine) == 'American' ? 'selected' : '' }}>American</option>
                                <option value="Indian" {{ old('cuisine', $recipe->cuisine) == 'Indian' ? 'selected' : '' }}>Indian</option>
                                <option value="Chinese" {{ old('cuisine', $recipe->cuisine) == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                <option value="Thai" {{ old('cuisine', $recipe->cuisine) == 'Thai' ? 'selected' : '' }}>Thai</option>
                                <option value="Mediterranean" {{ old('cuisine', $recipe->cuisine) == 'Mediterranean' ? 'selected' : '' }}>Mediterranean</option>
                                <option value="Other" {{ old('cuisine', $recipe->cuisine) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Category -->
                    <div class="mt-6">
                        <label class="block text-gray-700 font-medium mb-2">Category <span class="text-red-500">*</span></label>
                        <select name="category_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Recipe Media -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Recipe Photo</h2>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Current Image</label>
                        @if($recipe->image_path)
                            <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="{{ $recipe->title }}" class="w-full max-w-md h-auto rounded-lg mb-4">
                            <p class="text-sm text-gray-500 mb-4">Upload a new image to replace the current one, or leave empty to keep it.</p>
                        @else
                            <p class="text-sm text-gray-500 mb-4">No image currently set.</p>
                        @endif
                    </div>
                    
                    <div class="drag-drop-zone rounded-lg p-8 text-center cursor-pointer" id="recipe-image-drop" onclick="document.getElementById('image').click()">
                        <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="showPreview(this)">
                        <div id="preview-container" class="hidden mb-4">
                            <img id="image-preview" class="max-h-64 mx-auto rounded-lg">
                        </div>
                        <div id="upload-prompt">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600 mb-1">Drag and drop your image here or click to browse</p>
                            <p class="text-xs text-gray-500">Supports: JPG, PNG, GIF (Max 5MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Ingredients <span class="text-red-500">*</span></h2>
                    
                    <div class="space-y-4 mb-6" id="ingredients-container">
                        <!-- Ingredient Items -->
                        @foreach($recipe->ingredients as $index => $ingredient)
                        <div class="ingredient-item flex items-center space-x-4 p-3 rounded-lg">
                            <input type="text" name="ingredients[]" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Ingredient name" value="{{ $ingredient->name }}" required>
                            <input type="text" name="quantities[]" 
                                   class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Amount" value="{{ $ingredient->quantity }}">
                            <select name="units[]" class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="g" {{ $ingredient->unit == 'g' ? 'selected' : '' }}>g</option>
                                <option value="ml" {{ $ingredient->unit == 'ml' ? 'selected' : '' }}>ml</option>
                                <option value="cups" {{ $ingredient->unit == 'cups' ? 'selected' : '' }}>cups</option>
                                <option value="tbsp" {{ $ingredient->unit == 'tbsp' ? 'selected' : '' }}>tbsp</option>
                                <option value="tsp" {{ $ingredient->unit == 'tsp' ? 'selected' : '' }}>tsp</option>
                                <option value="" {{ $ingredient->unit == '' ? 'selected' : '' }}></option>
                            </select>
                            <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeIngredient(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                        
                        <!-- Empty ingredient template if no ingredients -->
                        @if(count($recipe->ingredients) == 0)
                        <div class="ingredient-item flex items-center space-x-4 p-3 rounded-lg">
                            <input type="text" name="ingredients[]" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Ingredient name" required>
                            <input type="text" name="quantities[]" 
                                   class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Amount">
                            <select name="units[]" class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option>g</option>
                                <option>ml</option>
                                <option>cups</option>
                                <option>tbsp</option>
                                <option>tsp</option>
                                <option></option>
                            </select>
                            <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeIngredient(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                    
                    <button type="button" class="flex items-center text-red-500 hover:text-red-600" onclick="addNewIngredient()">
                        <i class="fas fa-plus-circle mr-2"></i> Add Another Ingredient
                    </button>
                </div>

                <!-- Instructions -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Instructions <span class="text-red-500">*</span></h2>
                    
                    <div class="space-y-4 mb-6" id="steps-container">
                        <!-- Step Items -->
                        @foreach($recipe->steps as $index => $step)
                        <div class="step-item space-y-3 p-3 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center mt-1">
                                    <span class="step-number">{{ $index + 1 }}</span>
                                </div>
                                <textarea name="steps[]" rows="2" 
                                          class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                          placeholder="Describe this step..." required>{{ $step->description }}</textarea>
                                <button type="button" class="text-gray-400 hover:text-red-500 mt-1" onclick="removeStep(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="ml-10">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Step Image (Optional)</label>
                                <div class="flex items-center space-x-4">
                                    @if($step->image_path)
                                        <div class="current-step-image mb-2">
                                            <img src="{{ asset('storage/' . $step->image_path) }}" alt="Step {{ $index + 1 }}" class="h-20 w-auto rounded">
                                            <p class="text-xs text-gray-500">Current image</p>
                                        </div>
                                    @endif
                                    <input type="file" name="step_images[]" class="text-sm text-gray-500" accept="image/*">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Empty step template if no steps -->
                        @if(count($recipe->steps) == 0)
                        <div class="step-item space-y-3 p-3 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center mt-1">
                                    <span class="step-number">1</span>
                                </div>
                                <textarea name="steps[]" rows="2" 
                                          class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                          placeholder="Describe this step..." required></textarea>
                                <button type="button" class="text-gray-400 hover:text-red-500 mt-1" onclick="removeStep(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="ml-10">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Step Image (Optional)</label>
                                <input type="file" name="step_images[]" class="text-sm text-gray-500" accept="image/*">
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <button type="button" class="flex items-center text-red-500 hover:text-red-600" onclick="addNewStep()">
                        <i class="fas fa-plus-circle mr-2"></i> Add Another Step
                    </button>
                </div>

                <!-- Kitchen Equipment -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-6">Kitchen Equipment <span class="text-red-500">*</span></h2>
                    
                    <div class="space-y-4 mb-6" id="equipment-container">
                        <!-- Equipment Items -->
                        @foreach($recipe->equipment as $index => $equipment)
                        <div class="equipment-item flex items-center space-x-4 p-3 rounded-lg">
                            <input type="text" name="equipment[]" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Equipment name" value="{{ $equipment->name }}" required>
                            <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeEquipment(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                        
                        <!-- Empty equipment template if no equipment -->
                        @if(count($recipe->equipment) == 0)
                        <div class="equipment-item flex items-center space-x-4 p-3 rounded-lg">
                            <input type="text" name="equipment[]" 
                                   class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Equipment name" required>
                            <button type="button" class="text-gray-400 hover:text-red-500" onclick="removeEquipment(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                    
                    <button type="button" class="flex items-center text-red-500 hover:text-red-600" onclick="addNewEquipment()">
                        <i class="fas fa-plus-circle mr-2"></i> Add Another Equipment
                    </button>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('recipes.show', $recipe->id) }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        Update Recipe
                    </button>
                </div>
            </form>
        </div>
    </div>

     <!-- Footer could go here -->
     <x-footer />
    <script>
        function showPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-prompt').classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function addNewIngredient() {
            const container = document.getElementById('ingredients-container');
            const ingredientItems = container.getElementsByClassName('ingredient-item');
            const newIngredient = ingredientItems[0].cloneNode(true);
            
            // Clear input values
            const inputs = newIngredient.querySelectorAll('input');
            inputs.forEach(input => {
                input.value = '';
            });
            
            container.appendChild(newIngredient);
        }
        
        function removeIngredient(button) {
            const container = document.getElementById('ingredients-container');
            const ingredientItems = container.getElementsByClassName('ingredient-item');
            
            // Don't remove if it's the only ingredient
            if (ingredientItems.length > 1) {
                button.closest('.ingredient-item').remove();
            } else {
                // Clear values instead of removing
                const inputs = button.closest('.ingredient-item').querySelectorAll('input');
                inputs.forEach(input => {
                    input.value = '';
                });
            }
        }
        
        function addNewStep() {
            const container = document.getElementById('steps-container');
            const stepItems = container.getElementsByClassName('step-item');
            const newStep = stepItems[0].cloneNode(true);
            
            // Clear input values
            const textarea = newStep.querySelector('textarea');
            textarea.value = '';
            
            const fileInput = newStep.querySelector('input[type="file"]');
            fileInput.value = '';
            
            // Remove current image if it exists
            const currentImage = newStep.querySelector('.current-step-image');
            if (currentImage) {
                currentImage.remove();
            }
            
            // Update step number
            const stepNumber = newStep.querySelector('.step-number');
            stepNumber.textContent = stepItems.length + 1;
            
            container.appendChild(newStep);
        }
        
        function removeStep(button) {
            const container = document.getElementById('steps-container');
            const stepItems = container.getElementsByClassName('step-item');
            
            // Don't remove if it's the only step
            if (stepItems.length > 1) {
                const removedItem = button.closest('.step-item');
                removedItem.remove();
                
                // Update step numbers
                const updatedStepItems = container.getElementsByClassName('step-item');
                for (let i = 0; i < updatedStepItems.length; i++) {
                    updatedStepItems[i].querySelector('.step-number').textContent = i + 1;
                }
            } else {
                // Clear values instead of removing
                const textarea = button.closest('.step-item').querySelector('textarea');
                textarea.value = '';
                
                const fileInput = button.closest('.step-item').querySelector('input[type="file"]');
                fileInput.value = '';
            }
        }
        
        function addNewEquipment() {
            const container = document.getElementById('equipment-container');
            const equipmentItems = container.getElementsByClassName('equipment-item');
            const newEquipment = equipmentItems[0].cloneNode(true);
            
            // Clear input value
            const input = newEquipment.querySelector('input');
            input.value = '';
            
            container.appendChild(newEquipment);
        }
        
        function removeEquipment(button) {
            const container = document.getElementById('equipment-container');
            const equipmentItems = container.getElementsByClassName('equipment-item');
            
            // Don't remove if it's the only equipment
            if (equipmentItems.length > 1) {
                button.closest('.equipment-item').remove();
            } else {
                // Clear value instead of removing
                const input = button.closest('.equipment-item').querySelector('input');
                input.value = '';
            }
        }
        
        // Drag and drop functionality
        const dropZone = document.getElementById('recipe-image-drop');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropZone.classList.add('border-red-500');
        }
        
        function unhighlight() {
            dropZone.classList.remove('border-red-500');
        }
        
        dropZone.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                document.getElementById('image').files = files;
                showPreview(document.getElementById('image'));
            }
        }
    </script>
</body>
</html>
