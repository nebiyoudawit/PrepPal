document.querySelector(".saves").addEventListener("click", function (event) {
  event.preventDefault(); // Prevent instant form submission

  const savedIcon = this.querySelector(".saved-state");
  const notSavedIcon = this.querySelector(".notsaved-state");
  const saveText = this.querySelector("span");
  const form = this.querySelector("form");

  // Toggle visibility
  if (notSavedIcon.style.display === "none") {
      notSavedIcon.style.display = "inline";
      savedIcon.style.display = "none";
      saveText.textContent = "Save";
  } else {
      notSavedIcon.style.display = "none";
      savedIcon.style.display = "inline";
      saveText.textContent = "Saved";
  }

  // Submit form to update the database
  form.submit();
});
document.querySelector(".likes").addEventListener("click", function (event) {
  event.preventDefault(); // Prevent instant form submission

  const likedIcon = this.querySelector(".liked-state");
  const notLikedIcon = this.querySelector(".notliked-state");
  const likeCount = this.querySelector("span");
  const form = this.querySelector("form");

  // Toggle visibility of the icons
  if (notLikedIcon.style.display === "none") {
      notLikedIcon.style.display = "inline";
      likedIcon.style.display = "none";
      likeCount.textContent = parseInt(likeCount.textContent) - 1;
  } else {
      notLikedIcon.style.display = "none";
      likedIcon.style.display = "inline";
      likeCount.textContent = parseInt(likeCount.textContent) + 1;
  }

  // Submit the form to update the database
  form.submit();
});

  //category color 
  document.addEventListener('DOMContentLoaded', function() {
    // Select all category elements
    const categories = document.querySelectorAll(".type");
  
    // Loop through each category and apply styles
    categories.forEach(function(category) {
        const categoryName = category.textContent.trim();
  
        if (categoryName === "Breakfast") {
            category.style.backgroundColor = "Yellow";
            category.style.color = "grey";
        } else if (categoryName === "Lunch") {
            category.style.backgroundColor = "#8DDA85"; 
        } else if (categoryName === "Dinner") {
            category.style.backgroundColor = "#BE270C"; 
        } else if (categoryName === "Snacks") {
            category.style.backgroundColor = "#FFC107"; 
        } else if (categoryName === "Dessert") {
            category.style.backgroundColor = "#A97CFF"; 
        } else {
            category.style.backgroundColor = "#BE270C"; 
        }
    });
  });