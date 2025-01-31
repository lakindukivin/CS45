const staffDetails = [
  {
    staffId: '001',
    name: 'John Doe',
    email: 'john.doe@example.com',
    contactNo: '123-456-7890',
    address: '123 Main St, Cityville',
    role: 'Manager',
    status: 'Active',
    duties: 'Operations, HR',
  },
  {
    staffId: '002',
    name: 'Jane Smith',
    email: 'jane.smith@example.com',
    contactNo: '987-654-3210',
    address: '456 Elm St, Townsville',
    role: 'Supervisor',
    status: 'Active',
    duties: 'Quality Control',
  },
  {
    staffId: '003',
    name: 'Michael Brown',
    email: 'michael.brown@example.com',
    contactNo: '555-123-4567',
    address: '789 Pine St, Villagetown',
    role: 'Technician',
    status: 'Active',
    duties: 'Maintenance',
  },
  {
    staffId: '004',
    name: 'Emily Davis',
    email: 'emily.davis@example.com',
    contactNo: '111-222-3333',
    address: '101 Maple St, Hamlet City',
    role: 'Analyst',
    status: 'Inactive',
    duties: 'Data Analysis',
  },
  {
    staffId: '005',
    name: 'Chris Johnson',
    email: 'chris.johnson@example.com',
    contactNo: '666-777-8888',
    address: '202 Oak St, Metropolis',
    role: 'Administrator',
    status: 'Active',
    duties: 'IT Support',
  },
];

const fetchStaffDetails = async () => {
  try {
    // const response = await fetch();
    //  if (!response.ok) throw new Error('Failed to fetch products');

    //  const customerDetails = await response.json();
    const tableBody = document.getElementById('staffTableBody');

    tableBody.innerHTML = staffDetails
      .map((staff) => {
        return `<tr>
          <td>${staff.staffId}</td>
          <td>${staff.name}</td>
          <td>${staff.email}</td>
          <td>${staff.contactNo}</td>
          <td>${staff.address}</td>
          <td>${staff.role}</td>
          <td>${staff.status}</td>
          <td>${staff.duties}</td>
          <td>
            <button class="edit-btn" onclick="editStaff('${staff.staffId}')">Edit</button>
            <button class="delete-btn" onclick="openDeleteModal('${staff.staffId}')">Delete</button>
          </td>
        </tr>`;
      })
      .join('');

    // document.getElementById('totalUsers').textContent = staffDetails.length;
  } catch (error) {
    console.error('Error:', error);
  }
};
fetchStaffDetails();

const editStaff = async (staffId) => {
  try {
    openEditModal();

    const staff = staffDetails.find((s) => s.staffId === staffId);

    document.getElementById('editStaffAccounts').userId.value = staff.staffId;
    document.getElementById('editStaffAccounts').editStaffName.value =
      staff.name;
    document.getElementById('editStaffAccounts').editStaffEmail.value =
      staff.email;
    document.getElementById('editStaffAccounts').editStaffContactNo.value =
      staff.contactNo;
    document.getElementById('editStaffAccounts').editStaffAddress.value =
      staff.address;
  } catch (error) {
    console.error('Error editing staff:', error);
  }
};

const openEditModal = () => {
  document.getElementById('editModal').style.display = 'block';
};

const closeEditModal = () => {
  document.getElementById('editModal').style.display = 'none';
};

const openDeleteModal = (staffId) => {
  const confirmDelete = confirm(
    `Are you sure you want to delete staff ID: ${staffId}?`
  );
  if (confirmDelete) {
    deleteStaff(staffId);
  }
};

const deleteStaff = (staffId) => {
  const index = staffDetails.findIndex((s) => s.staffId === staffId);
  if (index !== -1) {
    staffDetails.splice(index, 1);
    fetchStaffDetails();
  }
};


