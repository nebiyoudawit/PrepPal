document.addEventListener('DOMContentLoaded', function () {
    // Delete Recipe Handler
    document.body.addEventListener('click', function(event) {
        if (event.target && (event.target.classList.contains('delete-recipe-btn') || event.target.closest('.delete-recipe-btn'))) {
            const form = event.target.closest('form'); // Find the form associated with the delete button
            const recipeId = form.querySelector('input[name="delete_recipe_id"]').value; // Get the recipe ID from the input field

            // Prevent form submission by default
            event.preventDefault();

            // Confirmation prompt
            if (confirm(`Are you sure you want to delete recipe with ID ${recipeId}?`)) {
                form.submit(); // Submit the form to perform the deletion
            }

            // Stop the event from propagating further
            event.stopImmediatePropagation();
        }
    });

    // Delete User Handler
    document.body.addEventListener('click', function(event) {
        if (event.target && (event.target.classList.contains('delete-user-btn') || event.target.closest('.delete-user-btn'))) {
            const form = event.target.closest('form'); // Find the form associated with the delete button
            const userId = form.querySelector('input[name="delete_user_id"]').value; // Get the user ID from the input field

            // Prevent form submission by default
            event.preventDefault();

            // Confirmation prompt
            if (confirm(`Are you sure you want to delete user with ID ${userId}?`)) {
                form.submit(); // Submit the form to perform the deletion
            }

            // Stop the event from propagating further
            event.stopImmediatePropagation();
        }
    });

    // Delete Review Handler
    document.body.addEventListener('click', function(event) {
        if (event.target && (event.target.classList.contains('delete-review-btn') || event.target.closest('.delete-review-btn'))) {
            const form = event.target.closest('form'); // Find the form associated with the delete button
            const reviewId = form.querySelector('input[name="delete_review_id"]').value; // Get the review ID from the input field

            // Prevent form submission by default
            event.preventDefault();

            // Confirmation prompt
            if (confirm(`Are you sure you want to delete review with ID ${reviewId}?`)) {
                form.submit(); // Submit the form to perform the deletion
            }

            // Stop the event from propagating further
            event.stopImmediatePropagation();
        }
    });
});
