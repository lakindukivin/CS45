const customerDetails = [
  {
    userId: 'C001',
    name: 'John Doe',
    email: 'johndoe@example.com',
    contactNo: '+1234567890',
    address: '123 Green Street, Cityville',
    giveAwayAmount: '50 kg',
    purchasedAmount: '$200',
    savedCarbonFootprint: '15 kg',
  },
  {
    userId: 'C002',
    name: 'Jane Smith',
    email: 'janesmith@example.com',
    contactNo: '+9876543210',
    address: '456 Blue Avenue, Townsville',
    giveAwayAmount: '30 kg',
    purchasedAmount: '$120',
    savedCarbonFootprint: '10 kg',
  },
  {
    userId: 'C003',
    name: 'Alice Johnson',
    email: 'alicej@example.com',
    contactNo: '+1122334455',
    address: '789 Red Road, Villagetown',
    giveAwayAmount: '20 kg',
    purchasedAmount: '$80',
    savedCarbonFootprint: '8 kg',
  },
  {
    userId: 'C004',
    name: 'Bob Brown',
    email: 'bobbrown@example.com',
    contactNo: '+9988776655',
    address: '321 Yellow Lane, Hamletcity',
    giveAwayAmount: '40 kg',
    purchasedAmount: '$160',
    savedCarbonFootprint: '12 kg',
  },
  {
    userId: 'C005',
    name: 'Charlie Davis',
    email: 'charlied@example.com',
    contactNo: '+5566778899',
    address: '654 Purple Path, Countryside',
    giveAwayAmount: '10 kg',
    purchasedAmount: '$50',
    savedCarbonFootprint: '5 kg',
  },
];
const fetchCustomerDetails = async () => {
  try {
    // const response = await fetch();
    //  if (!response.ok) throw new Error('Failed to fetch products');

    //  const customerDetails = await response.json();
    const tableBody = document.getElementById('customerTableBody');

    tableBody.innerHTML = customerDetails
      .map((customer) => {
        return `<tr>
            <td>${customer.userId}</td>
            <td>${customer.name}</td>
            <td>${customer.email}</td>
            <td>${customer.contactNo}</td>
            <td>${customer.address}</td>
            <td>${customer.giveAwayAmount}</td>
            <td>${customer.purchasedAmount}</td>
            <td>${customer.savedCarbonFootprint}</td>
            
            <td>
            <button class="edit-btn" onclick="editCustomer('${customer.userId}')">Edit</button>
            <button class="delete-btn" onclick="openDeleteModal(${customer.userId})">Delete</button>
            </td>           
            </tr>
            `;
      })
      .join('');
    document.getElementById('totalUsers').textContent = staffDetails.length;
  } catch (error) {
    console.error('Error:', error);
  }
};
fetchCustomerDetails();

//edit

const editCustomer = async (customerID) => {
  try {
    openEditModal();
    // const response = await fetch(
    //  );

    // if (!response.ok) {
    //   throw new Error('Failed to fetch product details');
    // }

    // const customer= await response.json();

    const customer = customerDetails.find((customer) => {
      return customer.userId == customerID;
    });

    document.getElementById('editCustomerAccounts').userId.value =
      customer.userId;
    document.getElementById('editCustomerAccounts').editCustomerName.value =
      customer.name;
    document.getElementById('editCustomerAccounts').editCustomerEmail.value =
      customer.email;
    document.getElementById(
      'editCustomerAccounts'
    ).editCustomerContactNo.value = customer.contactNo;
    document.getElementById('editCustomerAccounts').editCustomerAddress.value =
      customer.address;
  } catch (error) {}
};

let currentCustomerId = null;

// Open Delete Confirmation Modal
const openDeleteConfirmationModal = (customerId) => {
  currentCustomerId = customerId; // Store the customer ID to delete
  openDeleteModal(); // Use the existing function from modal.js to open the delete modal
};

// Delete Customer Function
const deleteCustomer = async () => {
  try {
    const response = await fetch(
      'http://localhost/cs45/app/controllers/CustomerController.php?action=delete',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ customer_id: currentCustomerId }), // Send the customer ID to delete
      }
    );

    const result = await response.json();
    if (result.success) {
      closeDeleteModal(); // Use the existing function from modal.js to close the delete modal
      showSuccessMessage('Customer deleted successfully'); // Show success message
      fetchCustomerDetails(); // Refresh the customer list
    } else {
      alert(result.message || 'Failed to delete customer'); // Show error message
    }
  } catch (error) {
    console.error('Error:', error);
    alert('An error occurred while deleting the customer');
  }
};

// Show Success Message
const showSuccessMessage = (message) => {
  const successMessage = document.getElementById('successMessage');
  successMessage.querySelector('p').textContent = message; // Set the success message text
  successMessage.style.display = 'block'; // Show the success message modal
};

// Close Success Message
const closeSuccessMessage = () => {
  document.getElementById('successMessage').style.display = 'none'; // Hide the success message modal
};

// Event Listeners
document
  .getElementById('confirmDelete')
  .addEventListener('click', deleteCustomer); // Confirm delete
document
  .getElementById('cancelDelete')
  .addEventListener('click', closeDeleteModal); // Cancel delete (use existing function)
document
  .getElementById('closeSuccess')
  .addEventListener('click', closeSuccessMessage); // Close success message

// Close modals if user clicks outside the modal
window.addEventListener('click', (event) => {
  const deleteModal = document.getElementById('deleteModal');
  const successMessage = document.getElementById('successMessage');

  if (event.target === deleteModal) {
    closeDeleteModal(); // Close delete confirmation modal (use existing function)
  }
  if (event.target === successMessage) {
    closeSuccessMessage(); // Close success message modal
  }
});
