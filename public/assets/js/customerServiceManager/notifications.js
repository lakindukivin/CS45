document.addEventListener('DOMContentLoaded', function() {
    const notificationIcon = document.getElementById('notification-icon');
    const notificationPanel = document.getElementById('notification-panel');
    const notificationContent = document.getElementById('notification-content');
    const notificationCount = document.getElementById('notification-count');
    const markAllReadBtn = document.getElementById('mark-all-read');
    
    let notifications = [];
    let unreadCount = 0;
    
    // Toggle notification panel
    notificationIcon.addEventListener('click', function(e) {
        e.preventDefault();
        notificationPanel.classList.toggle('show');
        if (notificationPanel.classList.contains('show')) {
            fetchNotifications();
        }
    });
    
    // Close notification panel when clicking outside
    document.addEventListener('click', function(e) {
        if (!notificationPanel.contains(e.target) && e.target !== notificationIcon && !notificationIcon.contains(e.target)) {
            notificationPanel.classList.remove('show');
        }
    });
    
    // Mark all notifications as read
    markAllReadBtn.addEventListener('click', function() {
        notifications.forEach(notification => {
            notification.read = true;
        });
        updateNotificationDisplay();
        saveReadStatus();
    });
    
    // Fetch notifications from server
    function fetchNotifications() {
        notificationContent.innerHTML = '<div class="loading">Loading notifications...</div>';
        
        fetch(ROOT_URL + '/notifications/getNotifications')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    notificationContent.innerHTML = '<div class="error">' + data.error + '</div>';
                    return;
                }
                
                notifications = data.map(notification => {
                    // Check if notification is already read
                    const isRead = localStorage.getItem('notification_' + notification.id) === 'read';
                    return {
                        ...notification,
                        read: isRead
                    };
                });
                
                updateNotificationDisplay();
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                notificationContent.innerHTML = '<div class="error">Failed to load notifications</div>';
            });
    }
    
    // Update notification display
    function updateNotificationDisplay() {
        if (notifications.length === 0) {
            notificationContent.innerHTML = '<div class="empty">No notifications</div>';
            notificationCount.textContent = '0';
            notificationCount.style.display = 'none';
            return;
        }
        
        // Count unread notifications
        unreadCount = notifications.filter(notification => !notification.read).length;
        notificationCount.textContent = unreadCount;
        notificationCount.style.display = unreadCount > 0 ? 'flex' : 'none';
        
        // Build notification HTML
        let html = '';
        notifications.forEach(notification => {
            const dateFormatted = new Date(notification.date).toLocaleString();
            html += `
                <div class="notification-item ${notification.read ? 'read' : 'unread'}" data-id="${notification.id}">
                    <div class="notification-icon ${notification.type}"></div>
                    <div class="notification-info">
                        <div class="notification-message">${notification.message}</div>
                        <div class="notification-details">${notification.details}</div>
                        <div class="notification-time">${dateFormatted}</div>
                    </div>
                    <a href="${notification.url}" class="notification-link">View</a>
                </div>
            `;
        });
        
        notificationContent.innerHTML = html;
        
        // Add click event to mark individual notifications as read
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.dataset.id;
                const notification = notifications.find(n => n.id === id);
                if (notification && !notification.read) {
                    notification.read = true;
                    updateNotificationDisplay();
                    saveReadStatus(id);
                }
            });
        });
    }
    
    // Save read status to localStorage
    function saveReadStatus(id = null) {
        if (id) {
            localStorage.setItem('notification_' + id, 'read');
        } else {
            notifications.forEach(notification => {
                localStorage.setItem('notification_' + notification.id, 'read');
            });
        }
    }
    
    // Check for notifications periodically
    function checkNotifications() {
        fetch(ROOT_URL + '/notifications/getNotifications')
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    const oldCount = unreadCount;
                    
                    notifications = data.map(notification => {
                        const isRead = localStorage.getItem('notification_' + notification.id) === 'read';
                        return {
                            ...notification,
                            read: isRead
                        };
                    });
                    
                    unreadCount = notifications.filter(notification => !notification.read).length;
                    
                    // Update badge count
                    notificationCount.textContent = unreadCount;
                    notificationCount.style.display = unreadCount > 0 ? 'flex' : 'none';
                    
                    // Play sound if new notifications
                    if (unreadCount > oldCount && oldCount !== 0) {
                        playNotificationSound();
                    }
                    
                    // Update panel if it's open
                    if (notificationPanel.classList.contains('show')) {
                        updateNotificationDisplay();
                    }
                }
            })
            .catch(error => {
                console.error('Error checking notifications:', error);
            });
    }
    
    // Play notification sound
    function playNotificationSound() {
        const audio = new Audio(ROOT_URL + '/assets/sounds/notification.mp3');
        audio.play().catch(e => console.log('Sound play prevented'));
    }
    
    // Set the ROOT_URL from meta tag
    const ROOT_URL = document.querySelector('meta[name="root-url"]').getAttribute('content');
    
    // Initial check for notifications
    checkNotifications();
    
    // Check for new notifications every 30 seconds
    setInterval(checkNotifications, 30000);
});