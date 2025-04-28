const toggleButton = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');
const sidebarTitles = document.querySelectorAll('.sidebar-titles');
const userTitle = document.querySelector('.user-title');

// Responsive sidebar toggle
function toggleSidebar() {
  if (window.innerWidth <= 768) {
    // Mobile: slide in/out
    sidebar.classList.toggle('show');
  } else {
    // Desktop: collapse/expand
    sidebar.classList.toggle('close');
    sidebar.classList.toggle('compact');
    sidebarTitles.forEach((title) => title.classList.toggle('hide'));
    userTitle.classList.toggle('hide');
  }
}

// close sidebar when clicking outside on mobile
window.addEventListener('click', function (e) {
  if (
    window.innerWidth <= 768 &&
    sidebar.classList.contains('show') &&
    !sidebar.contains(e.target) &&
    e.target !== toggleButton
  ) {
    sidebar.classList.remove('show');
  }
});
