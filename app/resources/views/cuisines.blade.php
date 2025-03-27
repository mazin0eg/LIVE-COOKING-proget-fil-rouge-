<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - World Cuisines</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .cuisine-card {
            transition: all 0.3s ease;
        }

        .cuisine-card:hover {
            transform: translateY(-5px);
        }

        .recipe-card {
            transition: all 0.3s ease;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    
    <x-navbar />

    <!-- Hero Section -->
    <section class="relative py-20 bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" 
                 alt="World Cuisines"
                 class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6">
            <div class="max-w-3xl">
                <h1 class="text-5xl font-bold text-white mb-6">Explore World Cuisines</h1>
                <p class="text-xl text-gray-300 mb-8">Discover authentic recipes from different cultures around the globe</p>
                
                <!-- Search Bar -->
                <div class="flex bg-white rounded-lg shadow-lg p-2">
                    <input type="text" 
                           placeholder="Search cuisines or dishes..." 
                           class="flex-1 px-4 py-2 focus:outline-none">
                    <button class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Cuisines Grid -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Italian Cuisine -->
                <div class="cuisine-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352" 
                             alt="Italian Cuisine"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <img src="https://flagcdn.com/w40/it.png" 
                             alt="Italian Flag"
                             class="absolute top-4 right-4 w-8 rounded shadow">
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-xl font-bold text-white">Italian</h3>
                            <p class="text-gray-200 text-sm">284 Recipes</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Popular Dishes</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="text-sm font-medium">4.8</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Pasta</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Pizza</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Risotto</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Lasagna</span>
                        </div>
                    </div>
                </div>

                <!-- Japanese Cuisine -->
                <div class="cuisine-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1580822184713-fc5400e7fe10" 
                             alt="Japanese Cuisine"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <img src="https://flagcdn.com/w40/jp.png" 
                             alt="Japanese Flag"
                             class="absolute top-4 right-4 w-8 rounded shadow">
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-xl font-bold text-white">Japanese</h3>
                            <p class="text-gray-200 text-sm">196 Recipes</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Popular Dishes</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="text-sm font-medium">4.9</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Sushi</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Ramen</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Tempura</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Udon</span>
                        </div>
                    </div>
                </div>

                <!-- Mexican Cuisine -->
                <div class="cuisine-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1584208632869-05fa2b2a5934" 
                             alt="Mexican Cuisine"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <img src="https://flagcdn.com/w40/mx.png" 
                             alt="Mexican Flag"
                             class="absolute top-4 right-4 w-8 rounded shadow">
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-xl font-bold text-white">Mexican</h3>
                            <p class="text-gray-200 text-sm">168 Recipes</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Popular Dishes</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="text-sm font-medium">4.7</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Tacos</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Enchiladas</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Guacamole</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Burritos</span>
                        </div>
                    </div>
                </div>

                <!-- Add more cuisine cards here -->
            </div>
        </div>
    </section>

    <!-- Featured Recipes Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Featured Recipes by Cuisine</h2>
            
            <!-- Cuisine Tabs -->
            <div class="flex overflow-x-auto mb-8 pb-2 -mx-6 px-6">
                <button class="flex-none px-6 py-2 bg-red-500 text-white rounded-full mr-4">All</button>
                <button class="flex-none px-6 py-2 bg-gray-100 text-gray-700 rounded-full mr-4 hover:bg-gray-200">Italian</button>
                <button class="flex-none px-6 py-2 bg-gray-100 text-gray-700 rounded-full mr-4 hover:bg-gray-200">Japanese</button>
                <button class="flex-none px-6 py-2 bg-gray-100 text-gray-700 rounded-full mr-4 hover:bg-gray-200">Mexican</button>
                <button class="flex-none px-6 py-2 bg-gray-100 text-gray-700 rounded-full mr-4 hover:bg-gray-200">Indian</button>
                <button class="flex-none px-6 py-2 bg-gray-100 text-gray-700 rounded-full mr-4 hover:bg-gray-200">Chinese</button>
                <button class="flex-none px-6 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">More</button>
            </div>

            <!-- Recipe Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Recipe Card -->
                <div class="recipe-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" 
                             alt="Pasta Dish" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-white rounded-full p-1 text-sm font-medium flex items-center shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            4.8
                        </div>
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm">
                            <i class="far fa-heart text-red-500"></i>
                        </div>
                        <img src="https://flagcdn.com/w20/it.png" 
                             alt="Italian" 
                             class="absolute bottom-2 right-2 w-6 rounded shadow">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2">Classic Margherita Pizza</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="flex items-center mr-3">
                                <i class="far fa-clock mr-1"></i> 45 mins
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-utensils mr-1"></i> 4 servings
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                     alt="Chef" 
                                     class="w-6 h-6 rounded-full mr-2">
                                <span class="text-xs text-gray-500">Chef Antonio</span>
                            </div>
                            <span class="text-xs text-gray-500">2 days ago</span>
                        </div>
                    </div>
                </div>

                <!-- Add more recipe cards here -->
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-red-500">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Stay Updated with New Recipes</h2>
                <p class="text-white/80 mb-8">Get weekly updates on new recipes from different cuisines around the world.</p>
                <form class="flex max-w-md mx-auto">
                    <input type="email" 
                           placeholder="Enter your email" 
                           class="flex-1 px-4 py-3 rounded-l-lg focus:outline-none">
                    <button class="bg-gray-900 text-white px-6 py-3 rounded-r-lg hover:bg-gray-800 transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

   <!-- Footer could go here -->
   <x-footer />

    <script>
        // Update timestamp
        function updateTimestamp() {
            const timestampElement = document.querySelector('.text-gray-400');
            const now = new Date();
            timestampElement.textContent = now.toISOString().replace('T', ' ').slice(0, 19);
        }
        setInterval(updateTimestamp, 1000);

        // Heart toggle functionality
        document.querySelectorAll('.fa-heart').forEach(heart => {
            heart.addEventListener('click', function() {
                this.classList.toggle('fas');
                this.classList.toggle('far');
            });
        });
    </script>
</body>
</html>