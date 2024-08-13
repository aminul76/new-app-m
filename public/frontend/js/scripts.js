// Toggle the sidebar menu
function toggleMenu() {
    var sidebar = document.getElementById('sidebar');
    if (sidebar.style.left === '0px') {
        sidebar.style.left = '-250px';
    } else {
        sidebar.style.left = '0px';
    }
}

// Add a pulsing effect to elements with the 'live-text' class
$(document).ready(function() {
    $('.live-text').addClass('pulse'); // Add pulsing effect to live-text
});
