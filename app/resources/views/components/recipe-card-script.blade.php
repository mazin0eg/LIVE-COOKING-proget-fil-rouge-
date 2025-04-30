<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if user is authenticated
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        // If not authenticated, add click handlers to recipe cards
        if (!isAuthenticated) {
            const recipeCards = document.querySelectorAll('.recipe-card');
            recipeCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Get the original href
                    const href = this.getAttribute('href');
                    
                    // Store the URL to redirect after login
                    localStorage.setItem('intended_recipe_url', href);
                    
                    // Prevent default navigation
                    e.preventDefault();
                    
                    // Show login popup if it exists
                    if (typeof showLoginPopup === 'function') {
                        showLoginPopup();
                    } else {
                        // Fallback to redirect to login page
                        window.location.href = "{{ route('login') }}";
                    }
                });
            });
        }
    });
</script>
