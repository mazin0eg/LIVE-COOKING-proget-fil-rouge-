<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platea - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .login-image {
            background-image: url('https://images.unsplash.com/photo-1499028344343-cd173ffc68a9');
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
    </style>
</head>
<body class="bg-gray-50 h-screen">
    <div class="flex h-full">
        <!-- Left Side - Image -->
        <div class="hidden lg:flex lg:w-1/2 login-image relative">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-12 text-white max-w-lg">
                <h2 class="text-4xl font-bold mb-4">"Cooking with love provides food for the soul."</h2>
                <p class="text-gray-200">- Alan D. Wolfelt</p>
            </div>
            <!-- Time Display -->
            <div class="absolute top-4 left-4 text-white/80 flex items-center">
                <i class="far fa-clock mr-2"></i>
                <span>2025-03-18 15:00:56</span>
            </div>
            
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md form-fade-in">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center">
                        <div class="bg-red-500 rounded text-white p-2 mr-2">
                            <i class="fas fa-utensils text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-gray-800">Platea</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mt-6 mb-2">Welcome back</h2>
                    <p class="text-gray-600">Sign in to continue cooking</p>
                </div>

               

               

               

                <!-- Login Form -->
                <form class="space-y-6" action="{{route('login')}}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="text" 
                                name="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Enter your email"
                               required
                               autofocus>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-gray-700 font-medium">Password</label>
                            <a href="#" class="text-red-500 hover:text-red-600 text-sm">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" 
                            name="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Enter your password">
                            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" class="w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-500">
                            <span class="ml-2 text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition-colors">
                        Sign in
                    </button>
                </form>

                <!-- Sign Up Link -->
                <p class="text-center mt-8 text-gray-600">
                    Don't have an account? 
                    <a href="{{route('show.register')}}" class="text-red-500 hover:text-red-600 font-medium">Sign up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="fixed inset-0 bg-black/50 items-center justify-center hidden" id="loadingOverlay">
        <div class="bg-white rounded-lg p-8 flex flex-col items-center">
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-red-500 border-t-transparent"></div>
            <p class="mt-4 text-gray-600">Signing in...</p>
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

        // Progress bar animation based on form completion
        const inputs = document.querySelectorAll('input');
        const progressBar = document.getElementById('progressBar');

        function updateProgress() {
            const totalInputs = inputs.length;
            let filledInputs = 0;

            inputs.forEach(input => {
                if (input.value.length > 0) filledInputs++;
            });

            const progress = (filledInputs / totalInputs) * 100;
            progressBar.style.width = `${progress}%`;
        }

        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });

        // Initial progress update
        updateProgress();

        // Form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('loadingOverlay').classList.remove('hidden');
            document.getElementById('loadingOverlay').classList.add('flex');
            
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 1500);
        });
    </script>
</body>
</html>