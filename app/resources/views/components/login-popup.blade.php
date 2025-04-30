<!-- Login Popup Component -->
<div id="login-popup" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden transform transition-all">
        <!-- Header with close button -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Join Our Cooking Community</h3>
            <button type="button" class="text-white hover:text-gray-200" onclick="closeLoginPopup()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Body -->
        <div class="p-6">
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <div class="bg-red-500 rounded text-white p-3 inline-flex items-center justify-center">
                        <i class="fas fa-utensils text-3xl"></i>
                    </div>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">CookNow</h4>
                <p class="text-gray-700 mb-4">Sign in to start cooking with us! Track your progress, save your favorite recipes, and join our community of food enthusiasts.</p>
            </div>
            
            <div class="space-y-4">
                <a href="{{ route('login') }}" class="block w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg text-center transition-colors">
                    Sign In
                </a>
                
                <div class="text-center">
                    <span class="text-gray-500">Don't have an account?</span>
                </div>
                
                <a href="{{ route('register') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded-lg text-center transition-colors">
                    Create Account
                </a>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 text-center">
            <p class="text-sm text-gray-500">By joining, you'll be able to track your cooking progress, save recipes, and more!</p>
        </div>
    </div>
</div>

<script>
    function showLoginPopup() {
        document.getElementById('login-popup').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeLoginPopup() {
        document.getElementById('login-popup').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
