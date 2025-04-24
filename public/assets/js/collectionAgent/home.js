let currentDate = new Date();
const today = new Date(); // Stores today's date

function renderCalendar() {
    const monthYear = document.getElementById('monthYear');
    const dates = document.getElementById('dates');

    // Set the current month and year
    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();
    monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

    // Clear previous dates
    dates.innerHTML = '';

    // Get the first day of the month
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
    const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

    // Add previous month's dates
    for (let i = firstDayOfMonth; i > 0; i--) {
        const prevMonth = month === 0 ? 11 : month - 1;
        const prevYear = month === 0 ? year - 1 : year;
        const date = document.createElement('div');
        date.classList.add('date', 'other-month');
        date.textContent = lastDateOfPrevMonth - i + 1;
        const formattedDate = `${prevYear}-${String(prevMonth + 1).padStart(2, '0')}-${String(lastDateOfPrevMonth - i + 1).padStart(2, '0')}`;
        date.setAttribute('data-date', formattedDate);
        dates.appendChild(date);
    }

    // Add current month's dates
    for (let i = 1; i <= lastDateOfMonth; i++) {
        const date = document.createElement('div');
        date.classList.add('date');
        date.textContent = i;
        
        // Format date as YYYY-MM-DD
        const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        date.setAttribute('data-date', formattedDate);

        // Highlight today
        if (
            year === today.getFullYear() &&
            month === today.getMonth() &&
            i === today.getDate()
        ) {
            date.classList.add('today');
        }

        dates.appendChild(date);
    }

    // Add next month's dates
    const remainingCells = 42 - (firstDayOfMonth + lastDateOfMonth);
    for (let i = 1; i <= remainingCells; i++) {
        const nextMonth = month === 11 ? 0 : month + 1;
        const nextYear = month === 11 ? year + 1 : year;
        const date = document.createElement('div');
        date.classList.add('date', 'other-month');
        date.textContent = i;
        const formattedDate = `${nextYear}-${String(nextMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        date.setAttribute('data-date', formattedDate);
        dates.appendChild(date);
    }
    
    // Add click events to all dates after they're created
    addDateClickEvents();
}

function addDateClickEvents() {
    const dateElements = document.querySelectorAll('#dates .date');
    dateElements.forEach(dateElement => {
        dateElement.addEventListener('click', onDateClick);
    });
}

function onDateClick(event) {
    // Remove 'selected' class from all dates
    document.querySelectorAll('#dates .date').forEach(date => {
        date.classList.remove('selected');
    });
    
    // Add 'selected' class to clicked date
    event.target.classList.add('selected');
    
    const selectedDate = event.target.getAttribute('data-date');
    if (selectedDate) {
        fetchDayData(selectedDate);
    }
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initial calendar render
renderCalendar();

// timeeeeeeeeeeeeeeeee

function updateClock() {
    const now = new Date();

    // Convert to Sri Lanka time (UTC+5:30)
    const options = { timeZone: 'Asia/Colombo', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    const sriLankaTime = now.toLocaleTimeString('en-GB', options);

    // Display time
    document.getElementById('clock').textContent = sriLankaTime ;
}

// Update clock every second
setInterval(updateClock, 1000);

// Initial call to display clock immediately
updateClock();

// Fetch data for the selected day
function fetchDayData(formattedDate) {
    // Get the base URL from a hidden input or other source
    const rootUrl = document.querySelector('meta[name="root-url"]')?.getAttribute('content') || '';
    
    fetch(`${rootUrl}/CollectionAgent/getDayData?date=${formattedDate}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error('Error from server:', data.error);
                return;
            }
            
            // Update the dashboard with the new data
            document.getElementById('giveaways-count').textContent = data.giveaways;
            document.getElementById('customer-count').textContent = data.customers;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Display data for the selected day
function displayDayData(data) {
    // Ensure data is always a number, default to 0 if undefined/null
    const giveaways = (typeof data.giveaways === 'number') ? data.giveaways : (parseInt(data.giveaways) || 0);
    const returns = (typeof data.customers === 'number') ? data.customers : (parseInt(data.customers) || 0);

    document.getElementById('giveaways-count').textContent = giveaways;
    document.getElementById('customer-count').textContent = customers;
}

// Ensure the calendar is re-rendered after changing months
document.addEventListener('DOMContentLoaded', () => {
    renderCalendar();
});
