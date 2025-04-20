document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const replyTextarea = document.querySelector("textarea[name='reply']");

    form.addEventListener("submit", function(e) {
        // Check if Decline was clicked AND reply is empty
        if (e.submitter?.name === "decline" && !replyTextarea.value.trim()) {
            e.preventDefault();
            alert("Please provide a reason for declining.");
            replyTextarea.focus();
        }
        // Accept button submits without checks
    });
});