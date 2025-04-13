document.addEventListener('DOMContentLoaded', function() {
  // Select all category elements
  const categories = document.querySelectorAll(".category");

  // Loop through each category and apply styles
  categories.forEach(function(category) {
      const categoryName = category.textContent.trim();

      if (categoryName === "Breakfast") {
          category.style.backgroundColor = "Yellow";
          category.style.color = "black";
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
document.getElementById("searchIcon").addEventListener("click", function() {
    document.getElementById("searchForm").submit();
});
