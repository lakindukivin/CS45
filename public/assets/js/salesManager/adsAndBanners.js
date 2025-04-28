function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
  setMinDateToToday();
}
function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('adForm').reset();
}

function openEditModal(
  ad_id,
  title,
  image,
  description,
  start_date,
  end_date,
  status
) {
  document.getElementById('editAdId').value = ad_id;
  document.getElementById('editAdTitle').value = title;
  document.getElementById('editAdImage').src = image
    ? 'http://localhost/cs45/public/' + image
    : '';
  document.getElementById('existingImagePath').value = image;
  document.getElementById('editAdDescription').value = description;
  document.getElementById('editAdStartDate').value = start_date;
  document.getElementById('editAdEndDate').value = end_date;
  document.getElementById('editStatus').value = status;
  document.getElementById('editModal').style.display = 'block';

  // Special handling for edit modal - ensure min dates are today
  // but don't restrict if the existing date is in the past
  setMinDateToToday();

  // Allow the current selected dates even if they're in the past
  const today = new Date();
  const startDate = new Date(start_date);

  if (startDate < today) {
    // For existing ads with past start dates, allow the current value
    document.getElementById('editAdStartDate').removeAttribute('min');
  }
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editAdForm').reset();
  currentadId = null;
}

function openDeleteModal(ad_id) {
  document.getElementById('deleteAdId').value = ad_id;
  document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteModal').style.display = 'none';
  currentadId = null;
}

// Set minimum date to today for date inputs
function setMinDateToToday() {
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = String(today.getMonth() + 1).padStart(2, '0');
  const dd = String(today.getDate()).padStart(2, '0');
  const todayFormatted = `${yyyy}-${mm}-${dd}`;

  // Set min attribute for all date inputs
  document.querySelectorAll('input[type="date"]').forEach((input) => {
    input.setAttribute('min', todayFormatted);
  });
}

// Validate description length
function validateDescription(input) {
  const minLength = 10;
  const maxLength = 500;
  const value = input.value.trim();

  if (value.length < minLength) {
    showError(input, `Description must be at least ${minLength} characters`);
    return false;
  }
  if (value.length > maxLength) {
    showError(input, `Description cannot exceed ${maxLength} characters`);
    return false;
  }
  removeError(input);
  return true;
}

// Validate image file
function validateImageFile(input) {
  if (input.files.length > 0) {
    const file = input.files[0];
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    const maxSize = 5 * 1024 * 1024; // 5MB

    if (!allowedTypes.includes(file.type)) {
      showError(input, 'File must be a valid image (JPEG, PNG, GIF, or WebP)');
      return false;
    }

    if (file.size > maxSize) {
      showError(input, 'File size must not exceed 5MB');
      return false;
    }
  }
  removeError(input);
  return true;
}

//refresh searchbar
document
  .querySelector('input[name="search"]')
  .addEventListener('input', function (e) {
    if (e.target.value.trim() === '') {
      window.location.href = window.location.pathname;
    }
  });

// Form validation setup
document.addEventListener('DOMContentLoaded', function () {
  // Set min dates on page load
  setMinDateToToday();

  // Add Ad/Banner form
  if (document.getElementById('adForm')) {
    setupFormValidation('adForm', {
      title: [
        { type: 'required' },
        { type: 'minLength', value: 3 },
        { type: 'maxLength', value: 100 },
      ],
      adImage: [
        { type: 'required' },
        { type: 'custom', validate: validateImageFile },
        { type: 'fileType', extensions: ['jpg', 'jpeg', 'png', 'gif', 'webp'] },
      ],
      description: [
        { type: 'required' },
        { type: 'custom', validate: validateDescription },
      ],
      startDate: [{ type: 'required' }, { type: 'dateFormat' }],
      endDate: [
        { type: 'required' },
        { type: 'dateFormat' },
        { type: 'dateOrder', related: 'startDate' },
      ],
    });
  }

  // Edit Ad/Banner form
  if (document.getElementById('editAdForm')) {
    setupFormValidation('editAdForm', {
      editAdTitle: [
        { type: 'required' },
        { type: 'minLength', value: 3 },
        { type: 'maxLength', value: 100 },
      ],
      editAdDescription: [
        { type: 'required' },
        { type: 'custom', validate: validateDescription },
      ],
      editAdStartDate: [{ type: 'required' }, { type: 'dateFormat' }],
      editAdEndDate: [
        { type: 'required' },
        { type: 'dateFormat' },
        { type: 'dateOrder', related: 'editAdStartDate' },
      ],
      editStatus: [{ type: 'required' }],
    });

    // Only validate file if one is selected (since it's optional on edit)
    const editFileInput = document.getElementById('editAdImage');
    if (editFileInput) {
      editFileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
          validateImageFile(this);
        } else {
          removeError(this);
        }
      });
    }
  }
});
