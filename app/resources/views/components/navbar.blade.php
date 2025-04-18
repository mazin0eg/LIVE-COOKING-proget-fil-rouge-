<nav class="bg-white py-3 px-6 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <div class="bg-red-500 rounded text-white p-1.5 mr-2">
                <i class="fas fa-utensils"></i>
            </div>
            <span class="text-xl font-bold text-gray-800">Platea</span>
        </div>
        
        <!-- Mobile Burger Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-gray-600 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <!-- Menu Items - Desktop -->
        <div class="hidden md:flex space-x-6">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="/admin" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Dashboard</a>
                @else
                    <a href="/" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Home</a>
                    <a href="/about" class="text-gray-800 font-medium hover:text-red-500 transition-colors">About</a>
                    <a href="/search" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Recipes</a>
                    <a href="/cuisines" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Cuisines</a>
                    <a href="/contact" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Contact</a>
                    @if(Auth::user()->role === 'chef')
                        <a href="{{ route('recipe.create') }}" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Add Recipe</a>
                    @endif
                @endif
            @else
                <a href="/" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Home</a>
                <a href="/about" class="text-gray-800 font-medium hover:text-red-500 transition-colors">About</a>
                <a href="/search" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Recipes</a>
                <a href="/cuisines" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Cuisines</a>
                <a href="/contact" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Contact</a>
            @endauth
        </div>
        
        <!-- Right Side Icons - Desktop -->
        <div class="hidden md:flex items-center space-x-4">
            @auth
                <span class="text-gray-600">Welcome, {{ Auth::user()->first_name }}!</span>
                @if(Auth::user()->role !== 'admin')
                    <a href="/profile" class="text-gray-600 hover:text-red-500 transition-colors">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition-colors shadow-sm">Sign out</button>
                </form>
            @else
                <a href="/register" class="text-gray-600 hover:text-red-500 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>Register
                </a>
                <a href="/login" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition-colors shadow-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            @endauth
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden mt-4 pb-4">
        <div class="flex flex-col space-y-3">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="/admin" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Dashboard</a>
                @else
                    <a href="/" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Home</a>
                    <a href="/about" class="text-gray-800 font-medium hover:text-red-500 transition-colors">About</a>
                    <a href="/search" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Recipes</a>
                    <a href="/cuisines" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Cuisines</a>
                    <a href="/contact" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Contact</a>
                    @if(Auth::user()->role === 'chef')
                        <a href="{{ route('recipe.create') }}" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Add Recipe</a>
                    @endif
                @endif
            @else
                <a href="/" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Home</a>
                <a href="/about" class="text-gray-800 font-medium hover:text-red-500 transition-colors">About</a>
                <a href="/search" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Recipes</a>
                <a href="/cuisines" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Cuisines</a>
                <a href="/contact" class="text-gray-800 font-medium hover:text-red-500 transition-colors">Contact</a>
            @endauth
        </div>
        <div class="mt-4 pt-4 border-t border-gray-200 flex flex-col space-y-3">
            @auth
                <span class="text-gray-600">Welcome, {{ Auth::user()->first_name }}!</span>
                @if(Auth::user()->role !== 'admin')
                    <a href="/profile" class="flex items-center text-gray-600 hover:text-red-500 transition-colors">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition-colors shadow-sm">Sign out</button>
                </form>
            @else
                <a href="/register" class="flex items-center text-gray-600 hover:text-red-500 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
                <a href="/login" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition-colors shadow-sm text-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>