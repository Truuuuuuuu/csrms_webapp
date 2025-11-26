document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('successBanner');
    if (!banner) return;

    // Trigger slide down
    setTimeout(() => {
        banner.classList.add('showBanner');
    }, 100); // small delay to apply CSS

    // Auto hide after 3 seconds
    setTimeout(() => {
        banner.classList.remove('showBanner');
        // Optional: remove from DOM after animation
        setTimeout(() => banner.remove(), 500);
    }, 4000);
});
