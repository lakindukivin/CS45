document.addEventListener('DOMContentLoaded', function() {
    const notificationItems = document.querySelectorAll('.notification-item');
    
    // Add click effect to notifications
    notificationItems.forEach(item => {
        item.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');
            
            if (!id) {
                console.error("No data-id attribute found on notification item");
                return;
            }

            // Add active class for visual feedback before navigation
            this.classList.add('active');

            // Navigation
            setTimeout(() => {
                switch(type) {
                    case 'order':
                        window.location.href = `${getRootUrl()}/ManageOrders`;
                        break;
                    case 'giveaway':
                        window.location.href = `${getRootUrl()}/GiveAwayRequest`;
                        break;
                    case 'review':
                        window.location.href = `${getRootUrl()}/ManageReviews`;
                        break;
                    case 'return':
                        window.location.href = `${getRootUrl()}/Returns/view`;
                        break;
                }
            }, 150); // Small delay for the effect to be visible
        });

        // Determine if notification is new (less than 30 minutes old)
        const timestampStr = item.querySelector('.notification-date span').textContent;
        const notificationTime = new Date(
            `${new Date().toDateString()} ${timestampStr}`
        );
        
        const thirtyMinutesAgo = new Date(Date.now() - 30 * 60 * 1000);
        
        if (notificationTime > thirtyMinutesAgo) {
            item.classList.add('new-notification');
        }
    });
    
    function getRootUrl() {
        const rootUrl = document.querySelector('meta[name="root-url"]')?.getAttribute('content') || '';
        return rootUrl;
    }
});
