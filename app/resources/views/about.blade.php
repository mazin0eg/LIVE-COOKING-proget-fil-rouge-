<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .chef-card {
            transition: all 0.3s ease;
        }
        
        .chef-card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Hero Section -->
    <section class="relative h-[50vh] bg-gray-900">
        <img src="https://images.unsplash.com/photo-1556910103-1e62330f7de0" 
             alt="Kitchen Team" 
             class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center">
            <div class="max-w-3xl px-4">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Meet Our Culinary Team</h1>
                <p class="text-xl text-gray-200">Passionate chefs and food enthusiasts bringing you the best recipes from around the world.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="stat-card bg-gray-50 rounded-lg p-6 text-center">
                    <div class="text-4xl font-bold text-red-500 mb-2">50+</div>
                    <div class="text-gray-600">Professional Chefs</div>
                </div>
                <div class="stat-card bg-gray-50 rounded-lg p-6 text-center">
                    <div class="text-4xl font-bold text-red-500 mb-2">1000+</div>
                    <div class="text-gray-600">Unique Recipes</div>
                </div>
                <div class="stat-card bg-gray-50 rounded-lg p-6 text-center">
                    <div class="text-4xl font-bold text-red-500 mb-2">25+</div>
                    <div class="text-gray-600">Cuisines</div>
                </div>
                <div class="stat-card bg-gray-50 rounded-lg p-6 text-center">
                    <div class="text-4xl font-bold text-red-500 mb-2">500K+</div>
                    <div class="text-gray-600">Happy Users</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Chefs Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Featured Chefs</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Chef Card 1 -->
                <div class="chef-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c" 
                             alt="Chef John Doe"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <h3 class="text-white text-xl font-bold">Chef John Doe</h3>
                            <p class="text-gray-300">Executive Chef</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Specializing in Italian cuisine with over 15 years of experience in top restaurants worldwide.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <a href="#" class="text-red-500 hover:text-red-600 font-medium">View Recipes</a>
                        </div>
                    </div>
                </div>

                <!-- Chef Card 2 -->
                <div class="chef-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1583394293214-28ded15ee548" 
                             alt="Chef Maria Garcia"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <h3 class="text-white text-xl font-bold">Chef Maria Garcia</h3>
                            <p class="text-gray-300">Pastry Chef</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Award-winning pastry chef known for creating innovative desserts and teaching aspiring bakers.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <a href="#" class="text-red-500 hover:text-red-600 font-medium">View Recipes</a>
                        </div>
                    </div>
                </div>

                <!-- Chef Card 3 -->
                <div class="chef-card bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1581299894007-aaa50297cf16" 
                             alt="Chef James Chen"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <h3 class="text-white text-xl font-bold">Chef James Chen</h3>
                            <p class="text-gray-300">Asian Cuisine Specialist</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Master of Asian fusion cuisine with expertise in traditional and modern cooking techniques.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <a href="#" class="text-red-500 hover:text-red-600 font-medium">View Recipes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Our Mission</h2>
                <p class="text-gray-600 mb-8">
                    At Platea, we believe that cooking is an art that brings people together. Our mission is to make cooking accessible, enjoyable, and inspiring for everyone, from beginners to experienced chefs.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heart text-2xl text-red-500"></i>
                        </div>
                        <h3 class="font-bold mb-2">Passion</h3>
                        <p class="text-gray-600 text-sm">We put love into every recipe</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-star text-2xl text-red-500"></i>
                        </div>
                        <h3 class="font-bold mb-2">Quality</h3>
                        <p class="text-gray-600 text-sm">Only the best recipes make the cut</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl text-red-500"></i>
                        </div>
                        <h3 class="font-bold mb-2">Community</h3>
                        <p class="text-gray-600 text-sm">Building connections through food</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Join Our Culinary Team</h2>
            <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
                Are you passionate about cooking and sharing your knowledge? We're always looking for talented chefs to join our community.
            </p>
            <a href="#" class="inline-block bg-red-500 text-white px-8 py-3 rounded-full hover:bg-red-600 transition-colors">
                Apply Now
            </a>
        </div>
    </section>

     <!-- Footer could go here -->
     <x-footer />
</body>
</html>