const profileInput = document.getElementById("profile-input");
const iconContainer = document.getElementById("icon-container");
const imagePreview = document.getElementById("image-preview");

profileInput.addEventListener("change", function (event) {
  const file = event.target.files[0];

  if (file) {
    // Create a FileReader to read the selected image
    const reader = new FileReader();

    reader.onload = function (e) {
      // Set the image preview
      const img = document.createElement("img");
      img.src = e.target.result;

      // Clear previous content and add the new image
      imagePreview.innerHTML = "";
      imagePreview.appendChild(img);

      // Hide the icon and show the image preview
      iconContainer.style.display = "none";
      imagePreview.style.display = "block";
    };

    reader.readAsDataURL(file); // Read the image as a data URL
  }
});
