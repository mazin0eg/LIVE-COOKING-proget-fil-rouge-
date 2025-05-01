<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Cooking - {{ $recipe->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .progress-ring {
            transition: stroke-dashoffset 0.5s ease;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
        
        .step-card {
            transition: all 0.3s ease;
        }
        
        .step-card.active {
            transform: scale(1.02);
            border-color: #ef4444;
        }
        
        .step-card.completed {
            opacity: 0.7;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Recipe Hero Section -->
    <section class="relative h-[40vh] bg-gray-900">
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
                            <span>Made by 
                                @if($recipe->user)
                                    {{ $recipe->user->first_name }} {{ $recipe->user->last_name }}
                                @else
                                    Unknown Chef
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Cooking Content -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar - Cooking Info & Controls -->
                <div class="lg:col-span-1">
                    <!-- Cooking Timer and Controls -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-4">
                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-bold mb-4">Ready to Cook?</h2>
                            <p class="text-gray-600 mb-6">Follow the steps and track your progress as you cook this delicious recipe.</p>
                            
                            <div class="relative mx-auto w-40 h-40 mb-4">
                                <svg class="w-full h-full" viewBox="0 0 100 100">
                                    <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50"/>
                                    <circle id="progress-ring" class="text-red-500 progress-ring" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="50" cy="50" stroke-dasharray="251.2" stroke-dashoffset="251.2"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span id="completed-steps" class="text-3xl font-bold text-gray-800">0</span>
                                    <span class="text-sm text-gray-500">of {{ count($recipe->steps) }}</span>
                                </div>
                            </div>
                            
                            <div id="cooking-timer-container" class="mb-6">
                                <h3 class="text-xl font-bold mb-2">Cooking Timer</h3>
                                <div class="cooking-timer text-3xl text-red-500 mb-4 font-mono" id="cooking-timer">00:00:00</div>
                                <div class="flex justify-center space-x-3">
                                    <button id="pause-timer" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition-colors">
                                        <i class="fas fa-pause mr-1"></i> Pause
                                    </button>
                                    <button id="complete-cooking" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                                        <i class="fas fa-check-circle mr-1"></i> Finish
                                    </button>
                                </div>
                            </div>
                            
                            <button id="start-cooking" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                <i class="fas fa-utensils mr-2"></i> Start Cooking
                            </button>
                        </div>
                        
                        <!-- Ingredients Quick Reference -->
                        <div class="border-t pt-6">
                            <h3 class="font-bold text-lg mb-3">Ingredients</h3>
                            <ul class="space-y-2 text-sm">
                                @foreach($recipe->ingredients as $ingredient)
                                <li class="flex items-start">
                                    <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                    <span class="ml-2">{{ $ingredient->quantity }} {{ $ingredient->unit }} {{ $ingredient->name }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content - Steps -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-2xl font-bold mb-6">Cooking Steps</h2>
                        <div class="space-y-6" id="cooking-steps">
                            @foreach($recipe->steps as $index => $step)
                            <div class="step-card p-4 border border-gray-200 rounded-lg" data-step="{{ $index + 1 }}">
                                <div class="flex items-start">
                                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center mr-3 flex-shrink-0">
                                        <span class="font-bold text-gray-700">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg mb-2">{{ $step->title }}</h3>
                                        <p class="text-gray-600 mb-4">{{ $step->description }}</p>
                                        
                                        @if($step->image_path)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $step->image_path) }}" alt="Step {{ $index + 1 }}" class="rounded-lg w-full h-48 object-cover">
                                        </div>
                                        @endif
                                        
                                        <div class="flex justify-between items-center">
                                            <div class="text-sm text-gray-500">
                                                @if($step->time)
                                                <span class="inline-flex items-center mr-3">
                                                    <i class="far fa-clock mr-1"></i> {{ $step->time }} mins
                                                </span>
                                                @endif
                                            </div>
                                            <button class="complete-step-btn bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg transition-colors">
                                                <i class="far fa-check-circle mr-1"></i> Complete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Equipment Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold mb-4">Equipment Needed</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($recipe->equipment as $equipment)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-utensils text-red-500 mr-3"></i>
                                <span>{{ $equipment->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Completion Modal -->
    <div id="completion-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden transform transition-all">
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Recipe Completed!</h3>
                <button type="button" class="text-white hover:text-gray-200" onclick="closeCompletionModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-6 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Congratulations!</h3>
                <p class="text-gray-600 mb-6">You've successfully completed cooking this recipe.</p>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="block text-sm text-gray-500">Time Spent</span>
                        <span class="block text-lg font-bold text-gray-800" id="total-time-spent">00:00:00</span>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="block text-sm text-gray-500">Steps Completed</span>
                        <span class="block text-lg font-bold text-gray-800" id="total-steps-completed">0/{{ count($recipe->steps) }}</span>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('welcome') }}" class="block w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg text-center transition-colors">
                        Find More Recipes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
    
    <!-- Add JavaScript for cooking functionality -->
    <script>
        // Track cooking state
        let cookingInProgress = false;
        let cookingId = null;
        let cookingStartTime = null;
        let cookingTimer = null;
        let cookingSeconds = 0;
        let completedSteps = 0;
        let totalSteps = {{ count($recipe->steps) }};
        let isPaused = false;
        
        document.addEventListener('DOMContentLoaded', function() {
            const startCookingBtn = document.getElementById('start-cooking');
            const pauseTimerBtn = document.getElementById('pause-timer');
            const completeCookingBtn = document.getElementById('complete-cooking');
            const completeStepBtns = document.querySelectorAll('.complete-step-btn');
            const cookingTimerDisplay = document.getElementById('cooking-timer');
            const progressRing = document.getElementById('progress-ring');
            const completedStepsDisplay = document.getElementById('completed-steps');
            
            // Hide timer controls initially
            document.getElementById('cooking-timer-container').style.display = 'none';
            
            // Start cooking button
            startCookingBtn.addEventListener('click', function() {
                if (!cookingInProgress) {
                    startCooking();
                }
            });
            
            // Pause timer button
            pauseTimerBtn.addEventListener('click', function() {
                if (isPaused) {
                    resumeTimer();
                } else {
                    pauseTimer();
                }
            });
            
            // Complete cooking button
            completeCookingBtn.addEventListener('click', function() {
                if (cookingInProgress) {
                    completeCooking();
                }
            });
            
            // Complete step buttons
            completeStepBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (cookingInProgress) {
                        const stepCard = this.closest('.step-card');
                        const stepNumber = parseInt(stepCard.dataset.step);
                        completeStep(stepNumber, stepCard);
                    }
                });
            });
            
            // Start cooking function
            function startCooking() {
                cookingInProgress = true;
                cookingStartTime = new Date();
                completedSteps = 0;
                
                // Update UI
                startCookingBtn.style.display = 'none';
                document.getElementById('cooking-timer-container').style.display = 'block';
                
                // Start timer
                startTimer();
                
                // Create cooking session in database
                fetch('{{ route("cooking.start", $recipe->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    cookingId = data.cooking_id;
                })
                .catch(error => {
                    console.error('Error starting cooking session:', error);
                });
            }
            
            // Timer functions
            function startTimer() {
                cookingSeconds = 0;
                cookingTimer = setInterval(updateTimer, 1000);
            }
            
            function updateTimer() {
                if (!isPaused) {
                    cookingSeconds++;
                    const hours = Math.floor(cookingSeconds / 3600);
                    const minutes = Math.floor((cookingSeconds % 3600) / 60);
                    const seconds = cookingSeconds % 60;
                    
                    cookingTimerDisplay.textContent = 
                        (hours < 10 ? '0' + hours : hours) + ':' +
                        (minutes < 10 ? '0' + minutes : minutes) + ':' +
                        (seconds < 10 ? '0' + seconds : seconds);
                }
            }
            
            function pauseTimer() {
                isPaused = true;
                pauseTimerBtn.innerHTML = '<i class="fas fa-play mr-1"></i> Resume';
                pauseTimerBtn.classList.replace('bg-yellow-500', 'bg-blue-500');
                pauseTimerBtn.classList.replace('hover:bg-yellow-600', 'hover:bg-blue-600');
            }
            
            function resumeTimer() {
                isPaused = false;
                pauseTimerBtn.innerHTML = '<i class="fas fa-pause mr-1"></i> Pause';
                pauseTimerBtn.classList.replace('bg-blue-500', 'bg-yellow-500');
                pauseTimerBtn.classList.replace('hover:bg-blue-600', 'hover:bg-yellow-600');
            }
            
            // Complete step function
            function completeStep(stepNumber, stepCard) {
                // Mark step as completed
                stepCard.classList.add('completed');
                const completeBtn = stepCard.querySelector('.complete-step-btn');
                completeBtn.disabled = true;
                completeBtn.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Completed';
                completeBtn.classList.replace('bg-gray-100', 'bg-green-100');
                completeBtn.classList.replace('hover:bg-gray-200', 'bg-green-100');
                completeBtn.classList.replace('text-gray-800', 'text-green-700');
                
                // Update completed steps count
                completedSteps++;
                completedStepsDisplay.textContent = completedSteps;
                
                // Update progress ring
                const circumference = 2 * Math.PI * 40;
                const offset = circumference - (completedSteps / totalSteps) * circumference;
                progressRing.style.strokeDashoffset = offset;
                
                // Update cooking progress in database
                if (cookingId) {
                    updateCookingProgress();
                }
                
                // Check if all steps are completed
                if (completedSteps === totalSteps) {
                    completeCooking();
                }
            }
            
            // Update cooking progress in database
            function updateCookingProgress() {
                fetch(`/cooking/update/${cookingId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        completed_steps: completedSteps,
                        total_steps: totalSteps,
                        time_spent: cookingSeconds
                    })
                })
                .catch(error => {
                    console.error('Error updating cooking progress:', error);
                });
            }
            
            // Complete cooking function
            function completeCooking() {
                // Stop timer
                clearInterval(cookingTimer);
                
                // Update database
                fetch(`/cooking/complete/${cookingId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        completed_steps: completedSteps,
                        total_steps: totalSteps,
                        time_spent: cookingSeconds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Show completion modal
                    document.getElementById('total-time-spent').textContent = cookingTimerDisplay.textContent;
                    document.getElementById('total-steps-completed').textContent = `${completedSteps}/${totalSteps}`;
                    showCompletionModal();
                })
                .catch(error => {
                    console.error('Error completing cooking session:', error);
                });
                
                // Reset cooking state
                cookingInProgress = false;
                cookingId = null;
            }
        });
        
        // Modal functions
        function showCompletionModal() {
            document.getElementById('completion-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        
        function closeCompletionModal() {
            document.getElementById('completion-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
</body>
</html>
