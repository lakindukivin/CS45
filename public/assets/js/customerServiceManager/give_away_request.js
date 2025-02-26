const modal = document.getElementById("giveawayModal");

function viewGiveaway(id) {
    fetch(`<?=ROOT?>/GiveAwayRequest/getDetails/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('giveaway_id').value = data.giveaway_id;
            document.getElementById('details').textContent = data.details;
            modal.style.display = "block";
        });
}

function closeModal() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

function updateStatus(status) {
    const formData = new FormData(document.getElementById('giveawayForm'));
    formData.append('status', status);

    fetch('<?=ROOT?>/GiveAwayRequest/updateStatus', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            closeModal();
            location.reload();
        }
    });
}
