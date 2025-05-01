<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CookNow - Recipe Details</title>
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
        
        .cooking-timer {
            font-family: 'Courier New', monospace;
            font-size: 2rem;
            font-weight: bold;
        }
        
        .step-completed {
            background-color: #f8fafc;
            border-left: 4px solid #22c55e;
        }
        
        .cooking-controls {
            transition: all 0.3s ease;
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
                        {{ $recipe->category ? $recipe->category->name : 'Uncategorized' }}
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
                            <span>by {{ $recipe->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recipe Content Section -->
    <!-- Recipe Description Section -->
    <section class="py-8 bg-white border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    <!-- Recipe Image -->
                    <div class="h-64 md:h-full overflow-hidden relative">
                        @if($recipe->image_path)
                            <img src="{{ asset('storage/' . $recipe->image_path) }}" 
                                alt="{{ $recipe->title }}" 
                                class="w-full h-full object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                                alt="Recipe Image" 
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    
                    <!-- Recipe Description -->
                    <div class="p-8 flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Recipe</h2>
                            <p class="text-gray-600 mb-6">{{ $recipe->description }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <span class="block text-sm text-gray-500">Prep Time</span>
                                    <span class="block text-lg font-bold text-gray-800">{{ $recipe->prep_time }} mins</span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <span class="block text-sm text-gray-500">Cook Time</span>
                                    <span class="block text-lg font-bold text-gray-800">{{ $recipe->cook_time }} mins</span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <span class="block text-sm text-gray-500">Servings</span>
                                    <span class="block text-lg font-bold text-gray-800">{{ $recipe->servings }}</span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <span class="block text-sm text-gray-500">Difficulty</span>
                                    <span class="block text-lg font-bold text-gray-800">{{ ucfirst($recipe->difficulty) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-auto">
                            @auth
                                <button id="start-cooking-main" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                    <i class="fas fa-utensils mr-2"></i> Start Cooking Now
                                </button>
                            @else
                                <button onclick="showLoginPopup()" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                    <i class="fas fa-utensils mr-2"></i> Start Cooking Now
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recipe Details Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar - Ingredients & Info -->
                <div class="lg:col-span-1">
                    <!-- Cooking Timer and Controls -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 text-center">
                        <div id="cooking-timer-container" class="mb-4 hidden">
                            <h3 class="text-xl font-bold mb-2">Cooking Timer</h3>
                            <div class="cooking-timer text-red-500 mb-2" id="cooking-timer">00:00:00</div>
                            <div class="flex justify-center space-x-2">
                                <button id="pause-timer" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                    <i class="fas fa-pause mr-1"></i> Pause
                                </button>
                                <button id="complete-cooking" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                                    <i class="fas fa-check-circle mr-1"></i> Done
                                </button>
                            </div>
                        </div>
                        
                        <div id="start-cooking-container">
                            <!-- Simple progress bar instead of SVG circle -->
                            <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                <div id="progress-bar" class="bg-red-500 h-4 rounded-full" style="width: 0%"></div>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-xl font-bold">Recipe Progress</h3>
                                <p class="text-gray-500" id="progress-text">0 of {{ count($recipe->steps) }} steps completed</p>
                                @auth
                                <button id="start-cooking" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors">
                                    <i class="fas fa-utensils mr-2"></i> Start Cooking
                                </button>
                                @else
                                <button onclick="showLoginPopup()" class="mt-4 inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors">
                                    <i class="fas fa-utensils mr-2"></i> Start Cooking
                                </button>
                                @endauth
                            </div>
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
                        <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden" data-step-id="{{ $step->id }}" data-step-order="{{ $step->order }}">
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
                                    <button class="step-toggle text-gray-400 hover:text-red-500 transition-colors" data-step="{{ $step->order }}">
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
    
    <!-- Login Popup for unauthenticated users -->
    @guest
        <x-login-popup />
    @endguest
    
    <!-- Add JavaScript for recipe progress functionality -->
    <script>
        // Simple variables to track progress
        let completedSteps = 0;
        const totalSteps = {{ count($recipe->steps) }};
        
        // Wait for the page to load
        document.addEventListener('DOMContentLoaded', function() {
            // Get all step toggle buttons
            const stepButtons = document.querySelectorAll('.step-toggle');
            
            // Add click event to each step button
            stepButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    toggleStepCompletion(this);
                });
            });
            
            // Get the start cooking button
            const startButton = document.getElementById('start-cooking');
            if (startButton) {
                startButton.addEventListener('click', function() {
                    startCooking();
                });
            }
            
            // Get the main start cooking button (if it exists)
            const mainStartButton = document.getElementById('start-cooking-main');
            if (mainStartButton) {
                mainStartButton.addEventListener('click', function() {
                    // Scroll to the cooking section
                    const timerSection = document.getElementById('cooking-timer-container');
                    if (timerSection) {
                        timerSection.scrollIntoView({ behavior: 'smooth' });
                        
                        // Click the start button after scrolling
                        setTimeout(function() {
                            if (startButton) {
                                startButton.click();
                            }
                        }, 800);
                    }
                });
            }
        });
        
        // Simple function to toggle step completion
        function toggleStepCompletion(button) {
            // Get the icon and step container
            const icon = button.querySelector('i');
            const stepContainer = button.closest('.recipe-step');
            
            // Check if step is already completed
            if (icon.classList.contains('far')) { // Not completed yet
                // Mark as completed
                icon.classList.remove('far', 'fa-circle');
                icon.classList.add('fas', 'fa-check-circle', 'text-green-500');
                stepContainer.classList.add('step-completed');
                completedSteps++;
            } else { // Already completed
                // Mark as not completed
                icon.classList.remove('fas', 'fa-check-circle', 'text-green-500');
                icon.classList.add('far', 'fa-circle');
                stepContainer.classList.remove('step-completed');
                completedSteps--;
            }
            
            // Update the progress display
            updateProgressDisplay();
        }
        
        // Simple function to update the progress bar
        function updateProgressDisplay() {
            // Calculate percentage
            const percentage = (completedSteps / totalSteps) * 100;
            
            // Update the progress bar width
            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                progressBar.style.width = percentage + '%';
            }
            
            // Update the text
            const progressText = document.getElementById('progress-text');
            if (progressText) {
                progressText.textContent = `${completedSteps} of ${totalSteps} steps completed`;
            }
        }
        
        // Simple function to start cooking
        function startCooking() {
            // Show the timer container
            const timerContainer = document.getElementById('cooking-timer-container');
            if (timerContainer) {
                timerContainer.classList.remove('hidden');
            }
            
            // Start the timer
            startTimer();
            
            // Enable all step buttons
            const stepButtons = document.querySelectorAll('.step-toggle');
            stepButtons.forEach(function(button) {
                button.classList.remove('text-gray-400');
                button.classList.add('text-gray-600');
                button.style.cursor = 'pointer';
            });
        }
        
        // Simple timer functionality
        let seconds = 0;
        let timerInterval;
        
        function startTimer() {
            // Reset timer if it's already running
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            
            // Reset seconds
            seconds = 0;
            
            // Update timer display immediately
            updateTimerDisplay();
            
            // Start interval to update every second
            timerInterval = setInterval(function() {
                seconds++;
                updateTimerDisplay();
            }, 1000);
            
            // Add event listeners to pause and complete buttons
            const pauseButton = document.getElementById('pause-timer');
            if (pauseButton) {
                pauseButton.addEventListener('click', togglePauseTimer);
            }
            
            const completeButton = document.getElementById('complete-cooking');
            if (completeButton) {
                completeButton.addEventListener('click', completeCooking);
            }
        }
        
        // Format time as HH:MM:SS
        function formatTime(totalSeconds) {
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;
            
            return [
                hours.toString().padStart(2, '0'),
                minutes.toString().padStart(2, '0'),
                seconds.toString().padStart(2, '0')
            ].join(':');
        }
        
        // Update the timer display
        function updateTimerDisplay() {
            const timerElement = document.getElementById('cooking-timer');
            if (timerElement) {
                timerElement.textContent = formatTime(seconds);
            }
        }
        
        // Toggle pause/resume timer
        function togglePauseTimer() {
            const pauseButton = document.getElementById('pause-timer');
            
            if (timerInterval) {
                // Timer is running, pause it
                clearInterval(timerInterval);
                timerInterval = null;
                
                if (pauseButton) {
                    pauseButton.innerHTML = '<i class="fas fa-play mr-1"></i> Resume';
                    pauseButton.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                    pauseButton.classList.add('bg-green-500', 'hover:bg-green-600');
                }
            } else {
                // Timer is paused, resume it
                timerInterval = setInterval(function() {
                    seconds++;
                    updateTimerDisplay();
                }, 1000);
                
                if (pauseButton) {
                    pauseButton.innerHTML = '<i class="fas fa-pause mr-1"></i> Pause';
                    pauseButton.classList.remove('bg-green-500', 'hover:bg-green-600');
                    pauseButton.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                }
            }
        }
        
        // Complete cooking
        function completeCooking() {
            // Stop the timer
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
            }
            
            // Save cooking progress to database
            @auth
            const recipeId = {{ $recipe->id }};
            
            // Send AJAX request to save progress
            fetch('/recipes/save-progress', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    recipe_id: recipeId,
                    cooking_time: seconds,
                    completed_steps: completedSteps,
                    total_steps: totalSteps
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show completion message
                    alert('Congratulations! You have completed cooking this recipe in ' + formatTime(seconds) + '. Your progress has been saved.');
                } else {
                    // Show completion message without saving confirmation
                    alert('Congratulations! You have completed cooking this recipe in ' + formatTime(seconds) + '.');
                }
            })
            .catch(error => {
                console.error('Error saving cooking progress:', error);
                // Show completion message even if saving failed
                alert('Congratulations! You have completed cooking this recipe in ' + formatTime(seconds) + '.');
            });
            @else
            // Show completion message for non-authenticated users
            alert('Congratulations! You have completed cooking this recipe in ' + formatTime(seconds) + '.');
            @endauth
            
            // Hide the timer container
            const timerContainer = document.getElementById('cooking-timer-container');
            if (timerContainer) {
                timerContainer.classList.add('hidden');
            }
        }
    </script>
</body>
</html>