document.addEventListener('DOMContentLoaded', function() {
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

    // Initial tab setup
    var activeTabButton = document.querySelector('.tab-button.tab-active');
    if (activeTabButton) {
        var sectionId = activeTabButton.getAttribute('data-section');
        showTab(sectionId, activeTabButton);
    }

    // Add event listener to handle book link clicks
    var bookingContainer = document.querySelector('.create-booking');
    bookingContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('book-link')) {
            event.preventDefault();
            var parkingSpot = event.target.closest('tr').querySelector('td').textContent;
            window.location.href = 'confirmBooking.php?parkingSpot=' + encodeURIComponent(parkingSpot);
        }
    });
});
