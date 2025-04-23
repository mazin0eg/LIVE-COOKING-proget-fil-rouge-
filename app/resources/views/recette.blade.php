<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - Recipe Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .recipe-step {
            transition: all 0.3s ease;
        }

        .recipe-step:hover {
            transform: translateY(-2px);
        }

        .floating-toolbar {
            transition: all 0.3s ease;
        }

        .floating-toolbar:hover {
            transform: translateY(-5px);
        }
        
        .progress-ring {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Recipe Hero Section -->
    <section class="relative h-[60vh] bg-gray-900">
        @if($recipe->image_path)
            <img src="{{ asset('storage/' . $recipe->image_path) }}" 
                 alt="{{ $recipe->title }}" 
                 class="w-full h-full object-cover opacity-60">
        @else
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                 alt="Recipe Hero Image" 
                 class="w-full h-full object-cover opacity-60">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="container mx-auto">
                <div class="max-w-4xl">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm mb-4 inline-block">
                        {{ $recipe->categories->first() ? $recipe->categories->first()->name : 'Uncategorized' }}
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $recipe->title }}</h1>
                    <div class="flex flex-wrap items-center gap-6 text-white">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $recipe->prep_time + $recipe->cook_time }} mins</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-friends mr-2"></i>
                            <span>{{ $recipe->servings }} servings</span>
                        </div>
                        <!-- Chef info -->
                        <div class="flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            <span>By: {{ $recipe->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recipe Content Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar - Ingredients & Info -->
                <div class="lg:col-span-1">
                    <!-- Progress Circle -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 text-center">
                        <svg class="w-32 h-32 mx-auto" viewBox="0 0 100 100">
                            <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50"/>
                            <circle class="text-red-500 progress-ring" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50" stroke-dasharray="251.2" stroke-dashoffset="251.2"/>
                        </svg>
                        <div class="mt-4">
                            <h3 class="text-xl font-bold">Recipe Progress</h3>
                            <p class="text-gray-500">0 of 6 steps completed</p>
                        </div>
                    </div>

                    <!-- Ingredients -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Ingredients</h2>
                        <ul class="space-y-3">
                            @foreach($recipe->ingredients as $ingredient)
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">{{ $ingredient->quantity }} {{ $ingredient->unit }} {{ $ingredient->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Kitchen Equipment -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Kitchen Equipment</h2>
                        <ul class="space-y-3">
                            @foreach($recipe->equipment as $equipment)
                            <li class="flex items-center">
                                <i class="fas fa-utensils text-red-500 mr-3"></i>
                                <span>{{ $equipment->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Serving Size Adjuster -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Adjust Servings</h2>
                        <div class="flex items-center justify-center space-x-4">
                            <button class="text-2xl text-gray-600 hover:text-red-500 transition-colors" onclick="adjustServings(-1)">
                                <i class="fas fa-minus-circle"></i>
                            </button>
                            <div class="text-center">
                                <span class="text-3xl font-bold text-gray-800" id="servingCount">4</span>
                                <p class="text-sm text-gray-500">servings</p>
                            </div>
                            <button class="text-2xl text-gray-600 hover:text-red-500 transition-colors" onclick="adjustServings(1)">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Content - Steps -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">About This Recipe</h2>
                        <p class="text-gray-600">{{ $recipe->description }}</p>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-8">
                        @foreach($recipe->steps as $step)
                        <!-- Step {{ $step->order }} -->
                        <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative h-64">
                                @if($step->image_path)
                                <img src="{{ asset('storage/' . $step->image_path) }}" 
                                     alt="Step {{ $step->order }}" 
                                     class="w-full h-full object-cover">
                                @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                                     alt="Step {{ $step->order }}" 
                                     class="w-full h-full object-cover">
                                @endif
                                <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                    {{ $step->order }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">Step {{ $step->order }}</h3>
                                    <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep({{ $step->order }})">
                                        <i class="far fa-circle text-2xl"></i>
                                    </button>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    {{ $step->description }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer could go here -->
    <x-footer />
    
    <!-- Add JavaScript for recipe progress functionality -->
    <script>
        // Track completed steps
        let completedSteps = 0;
        const totalSteps = 6;
        
        // Update progress ring and text
        function updateProgress() {
            // Update the progress ring
            const circumference = 2 * Math.PI * 40; // 2πr where r=40
            const progressRing = document.querySelector('.progress-ring');
            const offset = circumference - (completedSteps / totalSteps) * circumference;
            progressRing.style.strokeDasharray = `${circumference} ${circumference}`;
            progressRing.style.strokeDashoffset = offset;
            
            // Update the text
            document.querySelector('.mt-4 p').textContent = `${completedSteps} of ${totalSteps} steps completed`;
        }
        
        // Toggle step completion
        function toggleStep(stepNumber) {
            const button = event.currentTarget;
            const icon = button.querySelector('i');
            
            if (icon.classList.contains('far')) { // Step not completed
                icon.classList.remove('far', 'fa-circle');
                icon.classList.add('fas', 'fa-check-circle');
                completedSteps++;
            } else { // Step completed
                icon.classList.remove('fas', 'fa-check-circle');
                icon.classList.add('far', 'fa-circle');
                completedSteps--;
            }
            
            updateProgress();
        }
        
        // Initialize progress
        document.addEventListener('DOMContentLoaded', function() {
            updateProgress();
        });
    </script>
</body>
</html>