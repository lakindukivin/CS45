document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('modal');
    const declineBtn = document.getElementById('declineBtn');
    const closeModalBtn = document.querySelector('.close-btn');
    const declineForm = document.getElementById('declineForm');
    const mainForm = document.querySelector('form'); // Changed to querySelector

    declineBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    
        declineForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get the reason from the modal
            const reply = document.querySelector('#declineForm textarea[name="reply"]').value.trim();
            if (!reply) {
                alert('Please provide a reason for declining.');
                return;
            }
            
            // Remove any existing hidden inputs (if they exist)
        const existingReasonInput = mainForm.querySelector('input[name="reply"]');
        const existingActionInput = mainForm.querySelector('input[name="action"]');
        
        if (existingReasonInput) existingReasonInput.remove();
        if (existingActionInput) existingActionInput.remove();

        // Create a hidden input in the main form for the reason
        const reasonInput = document.createElement('input');
        reasonInput.type = 'hidden';
        reasonInput.name = 'reply';
        reasonInput.value = reply;
        
        // Create a hidden input for the action
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'decline';

        // Append the inputs to the main form
        mainForm.appendChild(reasonInput);
        mainForm.appendChild(actionInput);

        // Submit the main form
        mainForm.submit();
        
        // Close the modal
        modal.style.display = 'none';
    });
});