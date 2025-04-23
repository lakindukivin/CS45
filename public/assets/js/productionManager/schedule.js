const table = document.getElementById('collectionTable');
const modal = document.getElementById('modal');
const form = document.getElementById('scheduleForm');

function addSchedule(event) {
    event.preventDefault();
    form.submit(); // Let the form submit normally
}

function openModal(data = null) {
    modal.style.display = 'block';
    
    if (data) {
        document.getElementById('area').value = data.area;
        document.getElementById('date').value = data.date;
        document.getElementById('time').value = data.time;
        
        // Show edit and delete buttons
        const saveBtn = document.querySelector('.save-btn');
        saveBtn.textContent = 'Update';
        saveBtn.addEventListener('click', () => updateSchedule(data));
        
        const deleteBtn = document.createElement('.dlt-btn');
        deleteBtn.textContent = 'Delete';
        deleteBtn.className = 'dlt-btn';
        deleteBtn.addEventListener('click', () => deleteSchedule(data));
        saveBtn.parentNode.appendChild(deleteBtn);
    } else {
        // Reset form and hide edit/delete buttons
        form.reset();
        const saveBtn = document.querySelector('.save-btn');
        saveBtn.textContent = 'Save';
        saveBtn.removeEventListener('click', updateSchedule);
        
        const deleteBtn = document.querySelector('.dlt-btn');
        if (deleteBtn) {
            deleteBtn.parentNode.removeChild(deleteBtn);
        }
    }
}

function closeModal() {
    modal.style.display = 'none';
}

function addSchedule(event) {
    event.preventDefault();
    
    form.submit()
    
    closeModal();
}

function updateSchedule(oldData) {
    const area = document.getElementById('area').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    
    // Find the row with the old data and update it
    const rows = table.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells[0].textContent === oldData.area && cells[1].textContent === oldData.date && cells[2].textContent === oldData.time) {
            cells[0].textContent = area;
            cells[1].textContent = date;
            cells[2].textContent = time;
            break;
        }
    }
    
    closeModal();
}

function deleteSchedule(data) {
    // Find the row with the data and remove it
    const rows = table.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells[0].textContent === data.area && cells[1].textContent === data.date && cells[2].textContent === data.time) {
            table.deleteRow(i);
            break;
        }
    }
    
    closeModal();
}

form.addEventListener('submit', addSchedule);

populateTable();