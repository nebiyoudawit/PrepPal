<?php
include 'adminpage.php';
// Handle Delete Review
if (isset($_POST['delete_review_id'])) {
    $review_id = (int)$_POST['delete_review_id'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admindashboard.php"); // Refresh the page after deletion
    exit();
}


// Pagination Variables
$reviews_per_page = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $reviews_per_page;

// Fetch total review count
$total_reviews_result = $conn->query("SELECT COUNT(*) AS total FROM reviews");
$total_reviews_row = $total_reviews_result->fetch_assoc();
$total_reviews = $total_reviews_row['total'];
$total_pages = ceil($total_reviews / $reviews_per_page);

// Fetch reviews with pagination
$sql = "
    SELECT r.review_id, r.comment, r.created_at, u.name AS user_name, rec.r_name AS recipe_name
    FROM reviews r
    JOIN users u ON r.user_id = u.user_id
    JOIN recipes rec ON r.recipe_id = rec.recipe_id
    ORDER BY r.created_at DESC
    LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $reviews_per_page);
$stmt->execute();
$result = $stmt->get_result();
$reviews = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle review deletion
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin-reviews.php?page=$page"); // Refresh page after deletion
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Reviews - PrepPal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="styles/admin-reviews.css" />
</head>
<body>
    <div class="main-content">
        <header>
            <h1>Manage Reviews</h1>
        </header>

        <!-- Reviews Table -->
        <section class="manage-section">
            <h2>Reviews</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Recipe</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?= htmlspecialchars($review['review_id']) ?></td>
                            <td><?= htmlspecialchars($review['user_name']) ?></td>
                            <td><?= htmlspecialchars($review['recipe_name']) ?></td>
                            <td><?= htmlspecialchars($review['comment']) ?></td>
                            <td><?= htmlspecialchars($review['created_at']) ?></td>
                            <td>
                            <form action="admindashboard.php" method="POST">
                                <input type="hidden" name="delete_review_id" value="<?php echo $review['review_id']; ?>" />
                                <button type="submit" class="delete-review-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="prev">« Prev</a>
                <?php endif; ?>

                <span>Page <?= $page ?> of <?= $total_pages ?></span>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="next">Next »</a>
                <?php endif; ?>
            </div>
        </section>
    </div>
</body>
</html>
