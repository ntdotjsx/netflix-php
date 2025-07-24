let isVisible = false;
let currentAnimation = null;

// Netflix-style show animation
function showHeader() {
    if (isVisible || currentAnimation) return;

    currentAnimation = anime({
        targets: '#head',
        translateY: [
            { value: -20, duration: 0 },
            { value: 0, duration: 800, easing: 'easeOutQuart' }
        ],
        opacity: [
            { value: 0, duration: 0 },
            { value: 1, duration: 600, delay: 200, easing: 'easeOutQuart' }
        ],
        scale: [
            { value: 0.9, duration: 0 },
            { value: 1, duration: 800, easing: 'easeOutQuart' }
        ],
        complete: function () {
            isVisible = true;
            currentAnimation = null;
        }
    });

    // Animate children elements
    anime({
        targets: '#head h1, #head h2',
        translateX: [-30, 0],
        opacity: [0, 1],
        delay: anime.stagger(150, { start: 400 }),
        duration: 600,
        easing: 'easeOutQuart'
    });

    // Red bar animation
    anime({
        targets: '#head .red-bar',
        scaleY: [0, 1],
        duration: 500,
        delay: 300,
        easing: 'easeOutQuart'
    });
}

// Netflix-style hide animation
function hideHeader() {
    if (!isVisible || currentAnimation) return;

    currentAnimation = anime({
        targets: '#head',
        translateY: [0, -30],
        opacity: [1, 0],
        scale: [1, 0.95],
        duration: 500,
        easing: 'easeInQuart',
        complete: function () {
            isVisible = false;
            currentAnimation = null;
        }
    });

    // Animate children elements out
    anime({
        targets: '#head h1, #head h2',
        translateX: [0, -20],
        opacity: [1, 0],
        delay: anime.stagger(50),
        duration: 300,
        easing: 'easeInQuart'
    });
}

// Auto animation - shows for 8 seconds then disappears
function startAutoAnimation() {
    showHeader();

    // Hide after 8 seconds
    setTimeout(() => {
        if (isVisible) {
            hideHeader();
        }
    }, 8000);
}

// Auto-start when page loads
window.addEventListener('load', () => {
    setTimeout(startAutoAnimation, 500);
});