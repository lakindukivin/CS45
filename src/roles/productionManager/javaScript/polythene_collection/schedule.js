const table = document.getElementById('collectionTable');
const modal = document.getElementById('modal');
const form = document.getElementById('scheduleForm');

// Populate table with sample data
const sampleData = [
    { area: 'Area 1', date: '2023-05-01', time: '10:00' },
    { area: 'Area 2', date: '2023-05-02', time: '11:30' },
    { area: 'Area 3', date: '2023-05-03', time: '14:00' },
    // Add more sample data as needed
];

function populateTable() {
    sampleData.forEach(data => {
        const row = table.insertRow();
        row.addEventListener('click', () => openModal(data));
        
        const areaCell = row.insertCell();
        areaCell.textContent = data.area;
        
        const dateCell = row.insertCell();
        dateCell.textContent = data.date;
        
        const timeCell = row.insertCell();
        timeCell.textContent = data.time;
    });
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
        
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';
        deleteBtn.className = 'delete-btn';
        deleteBtn.addEventListener('click', () => deleteSchedule(data));
        saveBtn.parentNode.appendChild(deleteBtn);
    } else {
        // Reset form and hide edit/delete buttons
        form.reset();
        const saveBtn = document.querySelector('.save-btn');
        saveBtn.textContent = 'Save';
        saveBtn.removeEventListener('click', updateSchedule);
        
        const deleteBtn = document.querySelector('.delete-btn');
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
    
    const area = document.getElementById('area').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    
    // Add the new schedule to the table
    const row = table.insertRow();
    row.addEventListener('click', () => openModal({ area, date, time }));
    
    const areaCell = row.insertCell();
    areaCell.textContent = area;
    
    const dateCell = row.insertCell();
    dateCell.textContent = date;
    
    const timeCell = row.insertCell();
    timeCell.textContent = time;
    
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