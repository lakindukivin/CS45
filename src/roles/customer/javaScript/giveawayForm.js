// Define district data based on province selection
const districts = {
    "Western": ["Colombo", "Gampaha", "Kalutara"],
    "Central": ["Kandy", "Matale", "Nuwara Eliya"],
    "Southern": ["Galle", "Matara", "Hambantota"]
};

// Define towns data based on district selection
const towns = {
    "Colombo": ["Colombo 1", "Colombo 2", "Colombo 3"],
    "Gampaha": ["Negombo", "Gampaha Town", "Ja-Ela"],
    "Kalutara": ["Kalutara North", "Kalutara South", "Panadura"],
    "Kandy": ["Peradeniya", "Katugastota", "Pilimathalawa"],
    "Matale": ["Dambulla", "Matale Town", "Rattota"],
    "Nuwara Eliya": ["Hatton", "Nuwara Eliya Town", "Thalawakele"],
    "Galle": ["Galle Fort", "Unawatuna", "Hikkaduwa"],
    "Matara": ["Weligama", "Matara Town", "Dikwella"],
    "Hambantota": ["Tangalle", "Hambantota Town", "Tissamaharama"]
};

// Function to update the district dropdown
function updateDistricts() {
    let province = document.getElementById("province").value;
    let districtSelect = document.getElementById("district");

    // Clear existing options
    districtSelect.innerHTML = '<option value="">Select District</option>';
    document.getElementById("town").innerHTML = '<option value="">Select Town</option>';

    // Add new districts based on province
    if (province && districts[province]) {
        districts[province].forEach(district => {
            let option = document.createElement("option");
            option.value = district;
            option.textContent = district;
            districtSelect.appendChild(option);
        });
    }
}

// Function to update the town dropdown
function updateTowns() {
    let district = document.getElementById("district").value;
    let townSelect = document.getElementById("town");

    // Clear existing options
    townSelect.innerHTML = '<option value="">Select Town</option>';

    // Add new towns based on district
    if (district && towns[district]) {
        towns[district].forEach(town => {
            let option = document.createElement("option");
            option.value = town;
            option.textContent = town;
            townSelect.appendChild(option);
        });
    }
}
