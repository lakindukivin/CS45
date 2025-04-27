// Tab switching functionality
document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('.tab-btn');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach((tab) => {
    tab.addEventListener('click', function () {
      // Remove active class from all tabs
      tabs.forEach((t) => t.classList.remove('active'));

      // Add active class to current tab
      this.classList.add('active');

      // Hide all tab contents
      tabContents.forEach((content) => {
        content.style.display = 'none';
      });

      // Show current tab content
      const tabId = this.getAttribute('data-tab');
      document.getElementById(tabId + '-tab').style.display = 'block';
    });
  });
});
