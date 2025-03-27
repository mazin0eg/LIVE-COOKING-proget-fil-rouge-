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

        .progress-ring {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        .floating-toolbar {
            transition: all 0.3s ease;
        }

        .floating-toolbar:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Recipe Hero Section -->
    <section class="relative h-[60vh] bg-gray-900">
        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
             alt="Recipe Hero Image" 
             class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="container mx-auto">
                <div class="max-w-4xl">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm mb-4 inline-block">Italian Cuisine</span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Creamy Garlic Mushroom Pasta</h1>
                    <div class="flex flex-wrap items-center gap-6 text-white">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>25 mins</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-friends mr-2"></i>
                            <span>4 servings</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-fire-alt mr-2"></i>
                            <span>320 cal</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                            </div>
                            <span class="ml-2">(4.8)</span>
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
                            <p class="text-gray-500">0 of 7 steps completed</p>
                        </div>
                    </div>

                    <!-- Ingredients -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Ingredients</h2>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">200g pasta of your choice</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">1 tbsp olive oil</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">3 cloves garlic, minced</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">200g mushrooms, sliced</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">1 cup heavy cream</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">1/2 cup grated Parmesan cheese</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">Salt and pepper to taste</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500">
                                <span class="ml-3">Fresh parsley, chopped (for garnish)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Kitchen Equipment -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Kitchen Equipment</h2>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-utensils text-red-500 mr-3"></i>
                                <span>Large pot</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-utensils text-red-500 mr-3"></i>
                                <span>Large skillet</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-utensils text-red-500 mr-3"></i>
                                <span>Wooden spoon</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-utensils text-red-500 mr-3"></i>
                                <span>Measuring cups</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Nutrition Facts -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Nutrition Facts</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600">Calories</span>
                                <span class="font-bold">320</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600">Protein</span>
                                <span class="font-bold">12g</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600">Carbohydrates</span>
                                <span class="font-bold">48g</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600">Fat</span>
                                <span class="font-bold">9g</span>
                            </div>
                            <button class="w-full bg-gray-100 text-gray-600 px-4 py-2 rounded-full hover:bg-gray-200 transition-colors mt-2">
                                View Full Nutrition Facts
                            </button>
                        </div>
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
                <div class="lg:col-span-2">
                    <!-- Timer Bar -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 sticky top-20 z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-red-500 mr-2"></i>
                                <span class="text-xl font-bold" id="timer">25:00</span>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition-colors" id="startTimer">
                                    <i class="fas fa-play mr-1"></i> Start
                                </button>
                                <button class="bg-gray-200 text-gray-600 px-4 py-2 rounded-full hover:bg-gray-300 transition-colors" id="resetTimer">
                                    <i class="fas fa-redo mr-1"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-6">
                        <!-- Step 1 -->
                        <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative h-64">
                                <img src="https://images.unsplash.com/photo-1556761223-4c4282c73f77" 
                                     alt="Step 1" 
                                     class="w-full h-full object-cover">
                                <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                    1
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">Cook the pasta</h3>
                                    <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep(1)">
                                        <i class="far fa-circle text-2xl"></i>
                                    </button>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    Bring a large pot of salted water to boil. Add pasta and cook according to package instructions until al dente.
                                </p>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium mb-2">Pro Tips:</h4>
                                    <ul class="text-sm text-gray-600 list-disc list-inside">
                                        <li>Salt the water generously</li>
                                        <li>Stir occasionally to prevent sticking</li>
                                        <li>Reserve 1 cup of pasta water before draining</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative h-64">
                                <img src="https://images.unsplash.com/photo-1623428187969-5da2dcea5ebf" 
                                     alt="Step 2" 
                                     class="w-full h-full object-cover">
                                <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex</div> items-center justify-center font-bold">
                                    2
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">Sauté the garlic</h3>
                                    <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep(2)">
                                        <i class="far fa-circle text-2xl"></i>
                                    </button>
                                </div>
                                <p class="text-gray-600 mb-4">
                         </div>           In a large skillet, heat the olive oil over medium heat. Add the garlic and sauté for 1 minute until fragrant.
                                </p>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium mb-2">Important:</h4>
                                    <ul class="text-sm text-gray-600 list-disc list-inside">
                                        <li>Don't burn the garlic</li>
                                        <li>Keep heat at medium</li>
                                        <li>Stir constantly</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative h-64">
                                <img src="https://images.unsplash.com/photo-1599487488170-d11ec9c172f0" 
     alt="Cooking sliced mushrooms until golden"
     class="w-full h-full object-cover">
                                <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                    3
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">Cook the mushrooms</h3>
                                    <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep(3)">
                                        <i class="far fa-circle text-2xl"></i>
                                    </button>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    Add the mushrooms and cook for 5-7 minutes until they are golden brown.
                                </p>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium mb-2">Tips:</h4>
                                    <ul class="text-sm text-gray-600 list-disc list-inside">
                                        <li>Stir occasionally</li>
                                        <li>Don't overcrowd the pan</li>
                                        <li>Cook until mushrooms are golden brown</li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="relative h-64">
                            <img src="https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9" 
     alt="Creamy sauce with parmesan"
     class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                4
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold">Make the sauce</h3>
                                <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep(4)">
                                    <i class="far fa-circle text-2xl"></i>
                                </button>
                            </div>
                            <p class="text-gray-600 mb-4">
                                Reduce heat to low. Stir in heavy cream and Parmesan cheese. Cook 2-3 minutes until thick and creamy.
                            </p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-medium mb-2">Tips:</h4>
                                <ul class="text-sm text-gray-600 list-disc list-inside">
                                    <li>Stir constantly to prevent burning</li>
                                    <li>Keep heat low for creamy texture</li>
                                    <li>Adjust seasoning to taste</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="relative h-64">
                            <img src="https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9" 
     alt="Mixing pasta with creamy sauce"
     class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                5
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold">Combine pasta and sauce</h3>
                                <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep(5)">
                                    <i class="far fa-circle text-2xl"></i>
                                </button>
                            </div>
                            <p class="text-gray-600 mb-4">
                                Add cooked pasta to the skillet and toss to coat with the sauce evenly.
                            </p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-medium mb-2">Tips:</h4>
                                <ul class="text-sm text-gray-600 list-disc list-inside">
                                    <li>Add reserved pasta water if needed</li>
                                    <li>Toss gently to avoid breaking pasta</li>
                                    <li>Ensure even coating</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="recipe-step bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="relative h-64">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
     alt="Garnished creamy mushroom pasta"
     class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                6
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold">Season and serve</h3>
                                <button class="text-gray-400 hover:text-red-500 transition-colors" onclick="toggleStep(6)">
                                    <i class="far fa-circle text-2xl"></i>
                                </button>
                            </div>
                            <p class="text-gray-600 mb-4">
                                Season with salt and pepper to taste. Garnish with chopped fresh parsley and serve immediately.
                            </p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-medium mb-2">Final touches:</h4>
                                <ul class="text-sm text-gray-600 list-disc list-inside">
                                    <li>Serve while hot</li>
                                    <li>Optional: extra Parmesan on top</li>
                                    <li>Garnish with fresh herbs</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating Action Toolbar -->
<div class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50 floating-toolbar">
    <div class="bg-white rounded-full shadow-lg px-6 py-3 flex items-center space-x-4">
        <button class="text-gray-600 hover:text-red-500 transition-colors">
            <i class="fas fa-print"></i>
        </button>
        <button class="text-gray-600 hover:text-red-500 transition-colors">
            <i class="fas fa-share-alt"></i>
        </button>
        <button class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition-colors" onclick="toggleCookingMode()">
            Start Cooking Mode
        </button>
        <button class="text-gray-600 hover:text-red-500 transition-colors">
            <i class="far fa-bookmark"></i>
        </button>
        <button class="text-gray-600 hover:text-red-500 transition-colors">
            <i class="far fa-heart"></i>
        </button>
    </div>
</div>

 <!-- Footer could go here -->
 <x-footer />
</body>
</html>