document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to the parent element containing all book buttons
    var bookingContainer = document.querySelector('.create-booking');
    bookingContainer.addEventListener('click', function(event) {
        // Check if the clicked element is a book button
        if (event.target.classList.contains('book-link')) {
            event.preventDefault();
            var parkingSpot = event.target.parentNode.parentNode.firstElementChild.textContent;
            window.location.href = 'bookingForm.html?parkingSpot=' + encodeURIComponent(parkingSpot);
        }
    });

    // Function to handle tab switching
    function showTab(sectionId, element) {
        var tabs = document.querySelectorAll('.tab-button');
        var contents = document.querySelectorAll('.tab-content');
        var indicator = document.querySelector('.tab-indicator');

        tabs.forEach(function(tab) {
            tab.classList.remove('tab-active');
        });

        contents.forEach(function(content) {
            content.classList.remove('active');
        });

        var activeContent = document.querySelector(`#${sectionId}`);
        activeContent.classList.add('active');
        element.classList.add('tab-active');

        indicator.style.left = element.offsetLeft + 'px';
        indicator.style.width = element.offsetWidth + 'px';
    }

    // Add event listeners to the tab buttons
    var tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var sectionId = this.getAttribute('data-section');
            showTab(sectionId, this);
        });
    });
});
