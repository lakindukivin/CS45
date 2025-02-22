document.getElementById("province").addEventListener("change", updateDistricts);
document.getElementById("district").addEventListener("change", updateTowns);

const districtData = {
  western: ["Colombo", "Gampaha", "Kalutara"],
  central: ["Kandy", "Matale", "Nuwaraeliya"],
  southern: ["Galle", "Matara", "Hambantota"]
};

const townData = {
  Colombo: ["Colombo", "Kollupitiya", "Rajagiriya"],
  Gampaha: ["Gampaha Town", "Nittambuwa", "Veyangoda"],
  Kalutara: ["Kalutara", "Beruwala", "Moratuwa"],
  Kandy: ["Kandy", "Peradeniya", "Nuwara Eliya"],
  Matale: ["Matale", "Dambulla", "Sigiriya"],
  Nuwaraeliya: ["Nuwara Eliya", "Hatton", "Balangoda"],
  Galle: ["Galle", "Habaraduwa", "Unawatuna"],
  Matara: ["Matara", "Tangalle", "Mirissa"],
  Hambantota: ["Hambantota", "Tissamaharama", "Katuwana"]
};

function updateDistricts() {
  const province = document.getElementById("province").value;
  const districtSelect = document.getElementById("district");
  
  // Clear previous options
  districtSelect.innerHTML = "<option value=''>Select District</option>";

  if (province) {
    const districts = districtData[province] || [];
    districts.forEach(district => {
      const option = document.createElement("option");
      option.value = district;
      option.textContent = district;
      districtSelect.appendChild(option);
    });
  }
}

function updateTowns() {
  const district = document.getElementById("district").value;
  const townSelect = document.getElementById("town");
  
  // Clear previous options
  townSelect.innerHTML = "<option value=''>Select Town</option>";

  if (district) {
    const towns = townData[district] || [];
    towns.forEach(town => {
      const option = document.createElement("option");
      option.value = town;
      option.textContent = town;
      townSelect.appendChild(option);
    });
  }
}

// document.getElementById("giveawayForm").addEventListener("submit", function(event) {
//     event.preventDefault(); // Prevent actual form submission (remove this if needed)

//     // Simulating form submission (replace this with actual logic if needed)
//     setTimeout(() => {
//         window.location.href = "confirmation.html"; // Redirect to confirmation page
//     }, 1000);
// });

