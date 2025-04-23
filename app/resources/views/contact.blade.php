<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        .form-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .contact-card {
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar />

    <!-- Hero Section -->
    <section class="relative py-20 bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1428515613728-6b4607e44363" 
                 alt="Contact Us"
                 class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6">
            <div class="max-w-3xl">
                <h1 class="text-5xl font-bold text-white mb-6">Get in Touch</h1>
                <p class="text-xl text-gray-300">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
        </div>
    </section>

    <!-- Contact Information Cards -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Location Card -->
                <div class="contact-card bg-white rounded-lg p-8 text-center shadow-sm">
                    <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Visit Us</h3>
                    <p class="text-gray-600">123 Cooking Street</p>
                    <p class="text-gray-600">Kitchen City, KC 12345</p>
                    <p class="text-gray-600">United States</p>
                </div>

                <!-- Phone Card -->
                <div class="contact-card bg-white rounded-lg p-8 text-center shadow-sm">
                    <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Call Us</h3>
                    <p class="text-gray-600">Toll-free: +1 (800) 123-4567</p>
                    <p class="text-gray-600">Fax: +1 (800) 123-4568</p>
                    <p class="text-gray-600">Mon-Fri 9am-6pm EST</p>
                </div>

                <!-- Email Card -->
                <div class="contact-card bg-white rounded-lg p-8 text-center shadow-sm">
                    <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email Us</h3>
                    <p class="text-gray-600">support@platea.com</p>
                    <p class="text-gray-600">careers@platea.com</p>
                    <p class="text-gray-600">press@platea.com</p>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Send us a Message</h2>
                    
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    @if(session('info'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
                        <span class="block sm:inline">{{ session('info') }}</span>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <p class="font-bold">Please correct the following errors:</p>
                        <ul class="list-disc ml-5 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="space-y-6" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">First Name</label>
                                <input type="text" 
                                       name="first_name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                       placeholder="Enter your first name"
                                       value="{{ Auth::check() ? Auth::user()->first_name : old('first_name') }}"
                                       required>
                            </div>
                            
                            <!-- Last Name -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Last Name</label>
                                <input type="text" 
                                       name="last_name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                       placeholder="Enter your last name"
                                       value="{{ Auth::check() ? Auth::user()->last_name : old('last_name') }}"
                                       required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" 
                                   name="email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                   placeholder="Enter your email address"
                                   value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                                   required>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Subject</label>
                            <select name="subject" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                    id="subjectSelect"
                                    required>
                                <option value="general">General Inquiry</option>
                                <option value="support">Customer Support</option>
                                <option value="feedback">Feedback</option>
                                <option value="chef_application" {{ Auth::check() && Auth::user()->role === 'cooker' ? 'selected' : '' }}>Chef Application</option>
                                <option value="recipe_suggestion">Recipe Suggestion</option>
                                <option value="other">Other</option>
                            </select>
                            @if(!Auth::check())
                                <p class="text-sm text-gray-500 mt-2"><i class="fas fa-info-circle mr-1"></i> You must be logged in to apply as a chef.</p>
                            @elseif(Auth::check() && Auth::user()->role === 'chef')
                                <p class="text-sm text-green-500 mt-2"><i class="fas fa-check-circle mr-1"></i> You are already approved as a chef!</p>
                            @elseif(Auth::check() && Auth::user()->role === 'cooker')
                                <p class="text-sm text-blue-500 mt-2"><i class="fas fa-info-circle mr-1"></i> Select "Chef Application" to apply to become a chef and add your own recipes!</p>
                            @endif
                        </div>

                        <!-- Chef Application Fields (hidden by default) -->
                        <div id="chefFields" class="hidden space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200 mt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Chef Application Details</h3>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Years of Experience <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       name="experience"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                       placeholder="e.g., 5 years">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Cuisine Speciality <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       name="speciality"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                       placeholder="e.g., Italian, French, etc.">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Why do you want to become a chef? <span class="text-red-500">*</span></label>
                                <textarea name="chef_reason" 
                                          rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                          placeholder="Tell us why you're passionate about sharing your recipes..."></textarea>
                            </div>
                            
                            <input type="hidden" name="is_chef_application" id="isChefApplication" value="0">
                            
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-sm text-blue-700">
                                    <i class="fas fa-info-circle mr-2"></i> Your application will be reviewed by our team. Once approved, you'll be able to add your own recipes to the platform!
                                </p>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea rows="6" 
                                      name="message"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                      placeholder="Enter your message"
                                      required></textarea>
                        </div>

                        <!-- Consent Checkbox -->
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   class="mt-1 w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-500"
                                   required>
                            <label class="ml-2 text-gray-600 text-sm">
                                I agree to the <a href="#" class="text-red-500 hover:text-red-600">Privacy Policy</a> and consent to having my data processed.
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full py-3 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition-colors flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                        <p class="text-sm text-gray-500 mt-4 text-center">
                            <i class="fas fa-envelope mr-1"></i> A copy of your message will be sent to your email for your records
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Find Us on the Map</h2>
                <div class="h-[400px] rounded-lg overflow-hidden shadow-sm">
                    <!-- Replace with actual map embed code -->
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.305935303!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1648132738953!5m2!1sen!2s" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Frequently Asked Questions</h2>
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <button class="flex justify-between items-center w-full">
                            <span class="font-medium text-gray-900">How do I submit a recipe?</span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div class="mt-4 text-gray-600 hidden">
                            To submit a recipe, log into your account and click on the "Submit Recipe" button in your dashboard. Follow the form instructions to add your recipe details, ingredients, and cooking steps.
                        </div>
                    </div>

                    <!-- Add more FAQ items -->
                </div>
            </div>
        </div>
    </section>

    <x-footer />

    <script>
        // FAQ Toggle
        document.querySelectorAll('.bg-white button').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('i');
                
                content.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });

        // Subject dropdown change handler
        document.getElementById('subjectSelect').addEventListener('change', function() {
            const chefFields = document.getElementById('chefFields');
            const isChefApplication = document.getElementById('isChefApplication');
            
            if (this.value === 'chef_application') {
                chefFields.classList.remove('hidden');
                isChefApplication.value = '1';
            } else {
                chefFields.classList.add('hidden');
                isChefApplication.value = '0';
            }
        });
    </script>
</body>
</html>