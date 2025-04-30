<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CookNow - Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .profile-image-preview {
            transition: all 0.3s ease;
        }
        
        .profile-image-preview:hover .overlay {
            opacity: 1;
        }
        
        .overlay {
            transition: opacity 0.3s ease;
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Edit Profile Form -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Profile</h1>
                
                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                    <strong class="font-bold">Oops! There were some problems with your submission.</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Profile Image -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Profile Picture</label>
                        <div class="flex items-center space-x-6">
                            <div class="relative w-32 h-32 rounded-full overflow-hidden profile-image-preview" id="profile-image-container">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->first_name }}" class="w-full h-full object-cover" id="profile-image-preview">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $user->first_name }}+{{ $user->last_name }}&background=random" alt="{{ $user->first_name }}" class="w-full h-full object-cover" id="profile-image-preview">
                                @endif
                                <div class="overlay absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                    <span class="text-white text-sm">Change Photo</span>
                                </div>
                            </div>
                            <div>
                                <input type="file" name="profile_image" id="profile-image-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                                <button type="button" onclick="document.getElementById('profile-image-input').click()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                    <i class="fas fa-camera mr-2"></i> Upload New Photo
                                </button>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF (Max. 2MB)</p>
                                @if($user->profile_image)
                                <div class="mt-2">
                                    <p class="text-xs text-gray-500">Current image: {{ basename($user->profile_image) }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Name Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="first_name" class="block text-gray-700 font-medium mb-2">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-gray-700 font-medium mb-2">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                    </div>
                    
                    <!-- Change Password Section -->
                    <div class="mb-6 border-t border-gray-200 pt-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Change Password</h2>
                        <p class="text-gray-600 mb-4">Leave these fields empty if you don't want to change your password.</p>
                        
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-700 font-medium mb-2">Current Password</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-gray-700 font-medium mb-2">New Password</label>
                                <input type="password" name="password" id="password" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Role Information (Non-editable) -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-2">Account Type</h3>
                        <div class="flex items-center">
                            @if($user->role === 'chef')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <i class="fas fa-chef-hat mr-1"></i> Chef
                                </span>
                                <p class="ml-3 text-sm text-gray-600">You can create and publish your own recipes.</p>
                            @elseif($user->role === 'admin')
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <i class="fas fa-crown mr-1"></i> Admin
                                </span>
                                <p class="ml-3 text-sm text-gray-600">You have full administrative access.</p>
                            @else
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <i class="fas fa-user mr-1"></i> Cooker
                                </span>
                                <p class="ml-3 text-sm text-gray-600">
                                    Want to share your recipes? 
                                    <a href="{{ route('contact') }}" class="text-red-500 hover:underline">Apply to become a chef</a>
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Form Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('profile') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />
    
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                    // Add a visual indication that the image has been selected
                    document.getElementById('profile-image-container').classList.add('ring-2', 'ring-red-500');
                }
                
                reader.readAsDataURL(input.files[0]);
                
                // Show filename
                const filename = input.files[0].name;
                const fileInfo = document.createElement('p');
                fileInfo.className = 'text-xs text-green-500 mt-2';
                fileInfo.textContent = 'Selected: ' + filename;
                
                // Remove any existing file info
                const existingInfo = input.parentNode.querySelector('.text-green-500');
                if (existingInfo) {
                    existingInfo.remove();
                }
                
                // Add the new file info
                input.parentNode.appendChild(fileInfo);
            }
        }
    </script>
</body>
</html>
