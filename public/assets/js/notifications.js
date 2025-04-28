function openNotificationModal() {
  document.getElementById('notificationModal').style.display = 'block';
}
function closeNotificationModal() {
  document.getElementById('notificationModal').style.display = 'none';
  const notificationItems = document.querySelectorAll('.notification-item');
  notificationItems.forEach((item) => {
    item.classList.remove('unread');
  });
}

document.addEventListener('DOMContentLoaded', function () {
  // Get all notification items
  const notificationItems = document.querySelectorAll('.notification-item');

  // Add click event to each notification item
  notificationItems.forEach((item) => {
    item.addEventListener('click', function () {
      const issueId = this.getAttribute('data-id');
      const issueType = this.getAttribute('data-type');

      // Redirect to the issues page with the specific issue highlighted
      window.location.href = `${getRootUrl()}/issues?highlight=${issueId}`;
    });
  });

  // Helper function to get root URL
  function getRootUrl() {
    // Try to get from meta tag if available
    const metaRoot = document.querySelector('meta[name="root-url"]');
    if (metaRoot) {
      return metaRoot.getAttribute('content');
    }

    // Otherwise try to extract from current location
    const pathArray = window.location.pathname.split('/');
    const appRoot = pathArray[1];
    return window.location.origin + '/' + appRoot;
  }
});
