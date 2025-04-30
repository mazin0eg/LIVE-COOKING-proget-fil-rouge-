<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNow - Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .register-image {
            background-image: url('https://images.unsplash.com/photo-1495521821757-a1efb6729352');
            background-size: cover;
            background-position: center;
        }

        .form-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .social-btn {
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
        }

        .step-indicator {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 h-screen">
    <div class="flex h-full">
        <!-- Left Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md form-fade-in">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center">
                        <div class="bg-red-500 rounded text-white p-2 mr-2">
                            <i class="fas fa-utensils text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-gray-800">CookNow</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mt-6 mb-2">Create your account</h2>
                    <p class="text-gray-600">Join our cooking community</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <p>Please fix these errors:</p>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Progress Steps -->
                <div class="flex justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">
                            1
                        </div>
                        <div class="ml-2">
                            <div class="text-sm font-medium text-gray-900">Account</div>
                            <div class="text-xs text-gray-500">Basic info</div>
                        </div>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200">
                            <div class="h-1 bg-red-500 w-0 transition-all duration-300"></div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <div class="ml-2">
                            <div class="text-sm font-medium text-gray-400">Profile</div>
                            <div class="text-xs text-gray-500">Your details</div>
                        </div>
                    </div>
                </div>

                <!-- Registration Form -->
                <form class="space-y-6" action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">First Name</label>
                            <input type="text" 
                                   name="first_name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Your first name"
                                   value="{{ old('first_name') }}"
                                   required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Last Name</label>
                            <input type="text" 
                                   name="last_name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Your last name"
                                   value="{{ old('last_name') }}"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input type="email" 
                               name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Your email address"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Password</label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Create a password"
                                   required>
                            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <p class="text-gray-500 text-sm mt-1">Must be at least 8 characters long</p>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                        <div class="relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Confirm your password"
                                   required>
                            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-500">
                        <label class="ml-2 text-gray-600 text-sm">
                            I agree to the <a href="#" class="text-red-500 hover:text-red-600">Terms of Service</a> and 
                            <a href="#" class="text-red-500 hover:text-red-600">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition-colors">
                        Continue
                    </button>
                </form>
     


                <!-- Sign In Link -->
                <p class="text-center mt-8 text-gray-600">
                    Already have an account? 
                    <a href="{{route('show.login')}}"  class="text-red-500 hover:text-red-600 font-medium">Sign in</a>
                </p>
            </div>
        </div>

        <!-- Right Side - Image -->
<div class="hidden lg:flex lg:w-1/2 register-image relative">
    <div class="absolute inset-0 bg-gradient-to-l from-black/60 to-transparent"></div>
    <div class="absolute bottom-0 right-0 p-12 text-white max-w-lg text-right">
        <h2 class="text-4xl font-bold mb-4">"Food is symbolic of love when words are inadequate."</h2>
        <p class="text-gray-200">- Alan D. Wolfelt</p>
    </div>
</div>

<!-- Additional Features -->
<div class="absolute top-4 right-4 flex space-x-4">
    <div class="text-white/80 flex items-center">
        <i class="far fa-clock mr-2"></i>
        <span>${formatDate('2025-03-18 14:54:33')}</span>
    </div>
</div>

<!-- Extra registration features -->
<div class="absolute top-4 left-4">
    <select class="bg-transparent text-white border border-white/20 rounded-lg px-3 py-1">
        <option value="en" class="text-gray-900">English</option>
        <option value="es" class="text-gray-900">Español</option>
        <option value="fr" class="text-gray-900">Français</option>
    </select>
</div>

</div>



<script>
    // Password visibility toggle
    document.querySelector('.fa-eye').parentElement.addEventListener('click', function() {
        const passwordInput = this.previousElementSibling;
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Progress bar animation
    let progress = 0;
    const progressBar = document.querySelector('.bg-red-500');
    
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => {
            let filledInputs = Array.from(document.querySelectorAll('input')).filter(input => input.value.length > 0).length;
            progress = (filledInputs / 6) * 100;
            progressBar.style.width = `${progress}%`;
        });
    });

   
</script>

</body>
</html>