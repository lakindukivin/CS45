const toggleButton = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');
const subMenu = document.getElementById('sub-menu');
const dropdownButtonImage = document.getElementById('dropdownbtn-img');
const sidebarTitles = document.querySelectorAll('.sidebar-titles');
const userTitle = document.querySelector('.user-title');

function toggleSidebar() {
  // Desktop behavior
  sidebar.classList.toggle('close');
  toggleButton.classList.toggle('rotate');
  sidebarTitles.forEach((title) => {
    title.classList.toggle('hide');
  });
  userTitle.classList.toggle('hide');
  dropdownButtonImage.classList.toggle('hide');
  closeAllSubMenus();
  //   if (window.innerWidth >= 768) {
  // } else {
  //   // Mobile behavior
  //   sidebar.classList.toggle('hide');
  // }
}

function toggleSubMenu() {
  if (sidebar.classList.contains('close')) {
    sidebar.classList.remove('close');
    toggleButton.classList.remove('rotate');

    sidebarTitles.forEach((title) => {
      title.classList.toggle('hide');
    });
    userTitle.classList.toggle('hide');
    dropdownButtonImage.classList.add('hide');
  }

  dropdownButtonImage.classList.remove('hide');
  subMenu.classList.toggle('show');
  dropdownButtonImage.classList.toggle('rotate');
}

function closeAllSubMenus() {
  Array.from(sidebar.getElementsByClassName('sub-menu')).forEach((ul) => {
    ul.classList.remove('show');
    ul.previousElementSibling.classList.remove('rotate');
  });
}

// function applyMobileStyles() {
//   if (window.innerWidth <= 768) {
//     sidebar.classList.add('hide'); // Hide the sidebar initially for mobile
//     sidebar.classList.remove('close'); // Remove desktop-only class
//   } else {
//     sidebar.classList.remove('hide'); // Show the sidebar for desktop
//   }
// }

// // Call on load and resize
// window.addEventListener('resize', applyMobileStyles);
// window.addEventListener('load', applyMobileStyles);

// // Close all open submenus before toggling the current one
//   if (!button.nextElementSibling.classList.contains('show')) {
//     closeAllSubMenus();
//   }

//   button.nextElementSibling.classList.toggle('show');
//   button.classList.toggle('rotate');

//   // If the sidebar is in a closed state, open it
//   if (sidebar.classList.contains('close')) {
//     sidebar.classList.remove('close');
//     toggleButton.classList.toggle('rotate');
//   