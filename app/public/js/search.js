/**
 * Simple search functionality for CookNow recipe website
 */

// Run code when page is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Start recipe search
    setupRecipeSearch();
    
    // Start cuisine search
    setupCuisineSearch();
});

// Recipe search function
function setupRecipeSearch() {
    // Get HTML elements
    const searchInput = document.getElementById('recipe-search-input');
    const searchButton = document.getElementById('recipe-search-button');
    const recipeCards = document.querySelectorAll('.recipe-card');
    
    // Exit if elements don't exist on this page
    if (!searchInput || !searchButton || recipeCards.length === 0) {
        return;
    }
    
    // Search when button is clicked
    searchButton.addEventListener('click', function() {
        searchRecipes();
    });
    
    // Search when Enter key is pressed
    searchInput.addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            searchRecipes();
        }
    });
    
    // Search as user types (when 3+ characters)
    searchInput.addEventListener('input', function() {
        if (searchInput.value.length >= 3 || searchInput.value.length === 0) {
            searchRecipes();
        }
    });
    
    // Apply filters when changed
    const filters = document.querySelectorAll('#recipe-filters select');
    if (filters.length > 0) {
        filters.forEach(filter => {
            filter.addEventListener('change', function() {
                searchRecipes();
            });
        });
    }
    
    // Main search function
    function searchRecipes() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;   
        
        // Check each recipe card
        recipeCards.forEach(card => {
            // Get text to search in
            const title = card.querySelector('h3')?.textContent || '';
            const cuisine = card.querySelector('.cuisine-tag')?.textContent || '';
            const description = card.querySelector('.recipe-description')?.textContent || '';
            const searchText = `${title} ${cuisine} ${description}`.toLowerCase();
            
            // Default to showing the card
            let shouldShow = true;
            
            // Check if search text matches query
            if (query !== '') {
                shouldShow = searchText.includes(query);
            }

            // Check if filters match
            if (shouldShow && filters.length > 0) {
                filters.forEach(filter => {
                    const filterValue = filter.value;
                    const filterType = filter.getAttribute('data-filter-type');
                    
                    // Skip "all" filter values
                    if (filterValue && filterValue !== 'all' && filterType) {
                        // Check cuisine filter
                        if (filterType === 'cuisine' && !cuisine.toLowerCase().includes(filterValue)) {
                            shouldShow = false;                                                                                                                                                                     
                        }                                                                                                                                                                       
                    }
                });
            }
            
            // Show or hide the card
            if (shouldShow) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Update results count
        const countElement = document.querySelector('.results-count');
        if (countElement) {
            countElement.textContent = `${visibleCount} Recipes Found`;
        }
    }
}

// Cuisine search function
function setupCuisineSearch() {
    // Get HTML elements
    const searchInput = document.getElementById('cuisine-search-input');
    const searchButton = document.getElementById('cuisine-search-button');
    const cuisineCards = document.querySelectorAll('.cuisine-card');
    
    // Exit if elements don't exist on this page
    if (!searchInput || !searchButton || cuisineCards.length === 0) {
        return;
    }
    
    // Search when button is clicked
    searchButton.addEventListener('click', function() {
        searchCuisines();
    });
    
    // Search when Enter key is pressed
    searchInput.addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            searchCuisines();
        }
    });
    
    // Search as user types (when 2+ characters)
    searchInput.addEventListener('input', function() {
        if (searchInput.value.length >= 2 || searchInput.value.length === 0) {
            searchCuisines();
        }
    });
    
    // Main cuisine search function
    function searchCuisines() {
        const query = searchInput.value.toLowerCase().trim();
        
        // Check each cuisine card
        cuisineCards.forEach(card => {
            // Get text to search in
            const name = card.querySelector('h3')?.textContent || '';
            const dishes = Array.from(card.querySelectorAll('.text-xs.bg-gray-100'))
                .map(dish => dish.textContent || '')
                .join(' ');
            const searchText = `${name} ${dishes}`.toLowerCase();
            
            // Show all cards if no query
            if (query === '') {
                card.style.display = 'block';
                return;
            }
            
            // Show or hide based on search match
            if (searchText.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
}
