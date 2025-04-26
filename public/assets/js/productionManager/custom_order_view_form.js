// document.addEventListener("DOMContentLoaded", function() {
//     const form = document.querySelector("form");
//     const replyTextarea = document.querySelector("textarea[name='reply']");

//     form.addEventListener("submit", function(e) {
//         // Check if Decline was clicked AND reply is empty
//         if (e.submitter?.name === "decline" && !replyTextarea.value.trim()) {
//             e.preventDefault();
//             alert("Please provide a reason for declining.");
//             replyTextarea.focus();
//         }
//         // Accept button submits without checks
//     });
// });

// document.getElementById('declineBtn').addEventListener('click', function(e) {
//     const replyTextarea = document.getElementById('replyTextarea');
//     const replyError = document.getElementById('replyError');
    
//     if (replyTextarea.value.trim() === '') {
//         e.preventDefault(); // Prevent form submission
//         replyError.style.display = 'block';
//         replyTextarea.focus();
//     } else {
//         replyError.style.display = 'none';
//     }
// });

document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('modal');
    const declineBtn = document.getElementById('declineBtn');
    const closeModalbtn = document.querySelector('.close-btn');
    const declineForm = document.getElementById('declineForm');
    const mainForm = document.querySelector('form');

    // Show modal when decline button is clicked
    declineBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Close modal when X is clicked
    closeModalbtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Handle decline form submission
    declineForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get the reason from the modal
        const reason = document.querySelector('#declineForm textarea[name="reason"]').value.trim();
        
        if (!reason) {
            alert('Please provide a reason for declining.');
            return;
        }

        // Remove any existing hidden inputs (if they exist)
        const existingReasonInput = mainForm.querySelector('input[name="reason"]');
        const existingActionInput = mainForm.querySelector('input[name="action"]');
        
        if (existingReasonInput) existingReasonInput.remove();
        if (existingActionInput) existingActionInput.remove();

        // Create a hidden input in the main form for the reason
        const reasonInput = document.createElement('input');
        reasonInput.type = 'hidden';
        reasonInput.name = 'reason';
        reasonInput.value = reason;
        
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