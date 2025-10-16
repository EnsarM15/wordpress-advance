/**
 * AutoDealer Pro Theme JavaScript
 * Enhanced functionality for the car dealership theme
 */

jQuery(document).ready(function($) {
    
    // Mobile menu toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.nav-menu').slideToggle();
    });
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
    
    // Car search form enhancements
    $('.search-form select[name="car_make"]').on('change', function() {
        var selectedMake = $(this).val();
        var modelSelect = $('.search-form select[name="car_model"]');
        
        // In a real implementation, you would make an AJAX call here
        // to get models for the selected make
        console.log('Make changed to: ' + selectedMake);
    });
    
    // Image gallery functionality (for single car pages)
    $('.car-images img').on('click', function() {
        var imageSrc = $(this).attr('src');
        // Create a lightbox or modal to display the full-size image
        // This is a placeholder for more advanced image gallery functionality
        console.log('Image clicked: ' + imageSrc);
    });
    
    // Contact form handling
    $('.contact-form, form').on('submit', function(e) {
        var form = $(this);
        var email = form.find('input[type="email"]').val();
        var name = form.find('input[type="text"]').val();
        
        // Basic validation
        if (!email || !name) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return false;
        }
        
        // In a real implementation, you would handle the form submission here
        // For now, we'll prevent the default action and show a message
        e.preventDefault();
        alert('Thank you for your inquiry! We will contact you soon.');
    });
    
    // Price range slider (if implemented)
    if ($('.price-range-slider').length) {
        $('.price-range-slider').on('input', function() {
            var minPrice = $('#min-price').val();
            var maxPrice = $('#max-price').val();
            $('.price-display').text('$' + minPrice + ' - $' + maxPrice);
        });
    }
    
    // Favorite cars functionality
    $('.favorite-btn').on('click', function(e) {
        e.preventDefault();
        var carId = $(this).data('car-id');
        var button = $(this);
        
        // Toggle favorite state
        if (button.hasClass('favorited')) {
            button.removeClass('favorited').html('♥ Add to Favorites');
            // Remove from favorites
        } else {
            button.addClass('favorited').html('❤️ Favorited');
            // Add to favorites
        }
        
        // In a real implementation, you would save this to the database or localStorage
        var favorites = JSON.parse(localStorage.getItem('favorite_cars') || '[]');
        if (button.hasClass('favorited')) {
            if (favorites.indexOf(carId) === -1) {
                favorites.push(carId);
            }
        } else {
            var index = favorites.indexOf(carId);
            if (index > -1) {
                favorites.splice(index, 1);
            }
        }
        localStorage.setItem('favorite_cars', JSON.stringify(favorites));
    });
    
    // Load favorite cars on page load
    var favorites = JSON.parse(localStorage.getItem('favorite_cars') || '[]');
    $('.favorite-btn').each(function() {
        var carId = $(this).data('car-id');
        if (favorites.indexOf(carId) > -1) {
            $(this).addClass('favorited').html('❤️ Favorited');
        }
    });
    
    // Car comparison functionality
    $('.compare-btn').on('click', function(e) {
        e.preventDefault();
        var carId = $(this).data('car-id');
        var comparison = JSON.parse(localStorage.getItem('car_comparison') || '[]');
        
        if (comparison.length >= 3 && comparison.indexOf(carId) === -1) {
            alert('You can only compare up to 3 cars at a time.');
            return;
        }
        
        if (comparison.indexOf(carId) === -1) {
            comparison.push(carId);
            $(this).html('✓ Added to Compare');
        }
        
        localStorage.setItem('car_comparison', JSON.stringify(comparison));
        updateComparisonCounter();
    });
    
    // Update comparison counter
    function updateComparisonCounter() {
        var comparison = JSON.parse(localStorage.getItem('car_comparison') || '[]');
        var counter = $('.comparison-counter');
        if (comparison.length > 0) {
            counter.text(comparison.length).show();
        } else {
            counter.hide();
        }
    }
    
    // Initialize comparison counter
    updateComparisonCounter();
    
    // Responsive image loading
    if ('IntersectionObserver' in window) {
        var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    var src = img.getAttribute('data-src');
                    if (src) {
                        img.src = src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            imageObserver.observe(img);
        });
    }
    
    // Animation on scroll
    $(window).on('scroll', function() {
        var scrollTop = $(this).scrollTop();
        var windowHeight = $(this).height();
        
        $('.car-card').each(function() {
            var elementTop = $(this).offset().top;
            var elementVisible = 150;
            
            if (scrollTop + windowHeight - elementVisible > elementTop) {
                $(this).addClass('animate-in');
            }
        });
    });
    
    // Filter form auto-submit
    $('.search-form select, .search-form input').on('change', function() {
        // Optional: Auto-submit form when filters change
        // $(this).closest('form').submit();
    });
    
    // Contact button actions
    $('button:contains("Call Now")').on('click', function() {
        window.location.href = 'tel:+15551234567';
    });
    
    $('button:contains("Email Dealer")').on('click', function() {
        window.location.href = 'mailto:sales@autodealer.com';
    });
    
    // Print functionality
    $('.print-btn').on('click', function() {
        window.print();
    });
    
    // Share functionality
    $('.share-btn').on('click', function(e) {
        e.preventDefault();
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: window.location.href
            });
        } else {
            // Fallback: Copy to clipboard
            var url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                alert('Link copied to clipboard!');
            });
        }
    });
    
    // Back to top button
    var backToTop = $('<button class="back-to-top" style="position: fixed; bottom: 20px; right: 20px; background: #ff6b35; color: white; border: none; padding: 10px 15px; border-radius: 50%; cursor: pointer; display: none; z-index: 1000;">↑</button>');
    $('body').append(backToTop);
    
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            backToTop.fadeIn();
        } else {
            backToTop.fadeOut();
        }
    });
    
    backToTop.on('click', function() {
        $('html, body').animate({scrollTop: 0}, 600);
    });
    
});

// Additional utility functions
function formatPrice(price) {
    return '$' + parseFloat(price).toLocaleString();
}

function formatMileage(mileage) {
    return parseFloat(mileage).toLocaleString() + ' miles';
}

// Car comparison page functionality
function showComparison() {
    var comparison = JSON.parse(localStorage.getItem('car_comparison') || '[]');
    if (comparison.length === 0) {
        alert('No cars selected for comparison.');
        return;
    }
    
    // In a real implementation, this would redirect to a comparison page
    window.location.href = '/compare?cars=' + comparison.join(',');
}

// Clear all comparisons
function clearComparison() {
    localStorage.removeItem('car_comparison');
    $('.compare-btn').html('Compare');
    $('.comparison-counter').hide();
}