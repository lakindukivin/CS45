function openCompletedGiveAwayPopup(giveaway) {
    document.getElementById('customer_id').value = giveaway.customer_id;
    document.getElementById('name').value = giveaway.name;
    document.getElementById('phone').value = giveaway.phone;
    document.getElementById('request_date').value = giveaway.request_date;
    document.getElementById('address').value = giveaway.address;
    document.getElementById('status').value = giveaway.status;
    document.getElementById('details').value = giveaway.details;

    document.getElementById('completedGiveAwayPopup').style.display = 'block';
    document.getElementById('completedGiveAwayPopupClose').addEventListener('click', () => {
      document.getElementById('completedGiveAwayPopup').style.display = 'none';
    });
  }