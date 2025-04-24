function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  
  if (window.innerWidth <= 768) {
    // Mobile behavior - slide in/out
    sidebar.classList.toggle('show');
  } else {
    // Desktop behavior - collapse/expand width
    sidebar.classList.toggle('close');
  }
}