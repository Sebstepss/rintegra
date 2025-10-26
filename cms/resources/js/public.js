// Public site JavaScript - Minimal and optimized
document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Form handling
    document.querySelectorAll('.contact-form').forEach(form => {
        form.addEventListener('submit', handleFormSubmit);
    });
    
    // Lazy loading for images (if not supported natively)
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
    
    // Mobile menu toggle (if needed)
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
});

// Form submission handler
async function handleFormSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('.form-submit');
    const messageDiv = form.parentNode.querySelector('.form-message');
    
    if (!submitBtn || !messageDiv) return;
    
    // Show loading state
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Enviando...';
    submitBtn.disabled = true;
    
    // Hide previous messages
    messageDiv.style.display = 'none';
    messageDiv.innerHTML = '';
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (response.ok) {
            // Success
            messageDiv.innerHTML = '<div class="alert alert-success">¡Mensaje enviado correctamente! Te contactaremos pronto.</div>';
            form.reset();
        } else {
            // Error from server
            const errorMessage = result.message || 'Error al enviar el mensaje. Inténtalo de nuevo.';
            messageDiv.innerHTML = `<div class="alert alert-error">${errorMessage}</div>`;
        }
    } catch (error) {
        // Network error
        messageDiv.innerHTML = '<div class="alert alert-error">Error de conexión. Verifica tu internet e inténtalo de nuevo.</div>';
        console.error('Form submission error:', error);
    }
    
    // Restore button state
    submitBtn.textContent = originalText;
    submitBtn.disabled = false;
    
    // Show message
    messageDiv.style.display = 'block';
    
    // Scroll to message if needed
    messageDiv.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Performance monitoring (optional)
if ('performance' in window && 'PerformanceObserver' in window) {
    // Monitor Largest Contentful Paint
    try {
        const po = new PerformanceObserver((list) => {
            const entries = list.getEntries();
            const lastEntry = entries[entries.length - 1];
            
            // Send to analytics if needed
            // console.log('LCP:', lastEntry.startTime);
        });
        po.observe({ entryTypes: ['largest-contentful-paint'] });
    } catch (e) {
        // Ignore if not supported
    }
}