document.addEventListener("DOMContentLoaded", function () {
    const recipeListContainer = document.getElementById("recipe-list-container");
    const addRecipeContainer = document.getElementById("add-recipe-container");
    const showAddRecipeBtn = document.getElementById("show-add-recipe");
    const cancelAddRecipeBtn = document.getElementById("cancel-add-recipe");

    // Show/hide add recipe form
    showAddRecipeBtn.addEventListener("click", function () {
        recipeListContainer.style.display = "none"; // Hide recipe list
        addRecipeContainer.style.display = "flex"; // Show add recipe form
    });

    cancelAddRecipeBtn.addEventListener("click", function () {
        addRecipeContainer.style.display = "none"; // Hide add recipe form
        recipeListContainer.style.display = "block"; // Show recipe list
    });

    let ingredientCount = 1;
    let instructionCount = 1;

    // Add ingredient functionality
    document.getElementById("add-ingredient").addEventListener("click", function () {
        ingredientCount++;
        let ingredientContainer = document.getElementById("ingredients-container");
        let newIngredient = document.createElement("div");
        newIngredient.classList.add("ingredient");
        newIngredient.innerHTML = `
            <input type="text" name="ingredients[]" placeholder="Enter ingredient ${ingredientCount}" required>
            <span class="remove-ingredient">×</span> <!-- "x" icon -->
        `;
        ingredientContainer.appendChild(newIngredient);
    });

    // Add instruction functionality
    document.getElementById("add-instruction").addEventListener("click", function () {
        instructionCount++;
        let instructionContainer = document.getElementById("instructions-container");
        let newInstruction = document.createElement("div");
        newInstruction.classList.add("instruction");
        newInstruction.innerHTML = `
            <input type="text" name="instructions[]" placeholder="Step ${instructionCount}" required>
            <span class="remove-instruction">×</span> <!-- "x" icon -->
        `;
        instructionContainer.appendChild(newInstruction);
    });

    // Remove ingredient functionality using event delegation
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-ingredient")) {
            event.target.parentElement.remove(); // Remove the ingredient input field
            reassignIngredientPlaceholders(); // Reassign placeholders for ingredients
        }
    });

    // Remove instruction functionality using event delegation
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-instruction")) {
            event.target.parentElement.remove(); // Remove the instruction input field
            reassignInstructionPlaceholders(); // Reassign placeholders for instructions
        }
    });

    // Function to reassign ingredient placeholders
    function reassignIngredientPlaceholders() {
        const ingredientInputs = document.querySelectorAll("#ingredients-container .ingredient input");
        ingredientInputs.forEach((input, index) => {
            input.placeholder = `Enter ingredient ${index + 1}`; // Reassign placeholders
        });
        ingredientCount = ingredientInputs.length; // Update ingredient count
    }

    // Function to reassign instruction placeholders
    function reassignInstructionPlaceholders() {
        const instructionInputs = document.querySelectorAll("#instructions-container .instruction input");
        instructionInputs.forEach((input, index) => {
            input.placeholder = `Step ${index + 1}`; // Reassign placeholders
        });
        instructionCount = instructionInputs.length; // Update instruction count
    }
});

// Delete Recipe Container
document.addEventListener('DOMContentLoaded', function () {
    // Event delegation: Add event listener to the parent container
    document.getElementById('recipe-list-container').addEventListener('click', function(event) {
        if (event.target && (event.target.classList.contains('delete-recipe') || event.target.closest('.delete-recipe'))) {
            const form = event.target.closest('form'); // Find the form associated with the delete button
            const recipeId = form.querySelector('input[name="recipe_id"]').value; // Get the recipe_id from the form
            console.log("Recipe ID to delete:", recipeId); // Log for debugging
            if (confirm("Are you sure you want to delete this recipe?")) {
                // Submit the form
                form.submit();
            }
        }
    });
});