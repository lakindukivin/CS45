const table = document.getElementById('collectionTable');
const modal = document.getElementById('modal');
const form = document.getElementById('scheduleForm');
const areaSelect = document.getElementById('area');
const dateInput = document.getElementById('date');
const timeInput = document.getElementById('time');

function validateForm() {
    let isValid = true;
    
    // Validate area
    if (!areaSelect.value) {
        showError(areaSelect, 'Please select an area');
        isValid = false;
    } else {
        clearError(areaSelect);
    }
    
    // Validate date
    if (!dateInput.value) {
        showError(dateInput, 'Please select a date');
        isValid = false;
    } else {
        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (selectedDate <= today) {
            showError(dateInput, 'Date must be in the future');
            isValid = false;
        } else {
            clearError(dateInput);
        }
    }
    
    // Validate time
    if (!timeInput.value) {
        showError(timeInput, 'Please select a time');
        isValid = false;
    } else {
        clearError(timeInput);
    }
    
    return isValid;
}

function showError(input, message) {
    const formGroup = input.closest('.form-group');
    let errorElement = formGroup.querySelector('.error-message');
    
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        formGroup.appendChild(errorElement);
    }
    
    errorElement.textContent = message;
    input.classList.add('error');
}

function clearError(input) {
    const formGroup = input.closest('.form-group');
    const errorElement = formGroup.querySelector('.error-message');
    
    if (errorElement) {
        errorElement.textContent = '';
    }
    
    input.classList.remove('error');
}

function addSchedule(event) {
    event.preventDefault();
    
    if (!validateForm()) {
        return;
    }
    
    form.submit();
    closeModal();
}

function openModal(data = null) {
    modal.style.display = 'block';
    
    // Clear any existing errors when opening modal
    clearError(areaSelect);
    clearError(dateInput);
    clearError(timeInput);
    
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

function updateSchedule(oldData) {
    if (!validateForm()) {
        return;
    }
    
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

// Add event listeners for real-time validation
areaSelect.addEventListener('change', () => {
    if (areaSelect.value) {
        clearError(areaSelect);
    }
});

dateInput.addEventListener('change', () => {
    if (dateInput.value) {
        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (selectedDate > today) {
            clearError(dateInput);
        }
    }
});

timeInput.addEventListener('change', () => {
    if (timeInput.value) {
        clearError(timeInput);
    }
});

form.addEventListener('submit', addSchedule);