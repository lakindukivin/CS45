function updateProfile() {
  const phone = document.getElementById("phone").value;
  const address = document.getElementById("address").value;
  const profilePictureInput = document.getElementById("profilePictureInput");
  const profilePicture = document.getElementById("profilePicture");

  if (profilePictureInput.files.length > 0) {
    const reader = new FileReader();
    reader.onload = function (e) {
      profilePicture.src = e.target.result;
    };
    reader.readAsDataURL(profilePictureInput.files[0]);
  }

  // Here you would typically send data to a backend server
  alert(
    `Profile Updated:\nName: ${name}\nEmail: ${email}\nPhone: ${phone}\nAddress: ${address}`
  );
}
