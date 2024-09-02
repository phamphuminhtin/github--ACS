<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Product Page</title>
</head>
<body>
    <h1>Product Title</h1>
    <!-- Hiển thị thông tin về sản phẩm -->
    <p>Product description...</p>

    <h2>Comments</h2>
    <div id="comments-section">
        <!-- Hiển thị danh sách bình luận -->
        <?php
        // Kết nối tới cơ sở dữ liệu
        $conn = new mysqli("localhost", "your_username", "your_password", "your_database");
        if ($conn->connect_error) {
            die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Truy vấn bình luận cho sản phẩm cụ thể
        $product_id = 1; // ID của sản phẩm
        $sql = "SELECT * FROM comments WHERE product_id = $product_id ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p><strong>User:</strong> " . $row["user_id"] . "</p>";
                echo "<p>" . $row["content"] . "</p>";
                echo "<p><em>Posted at: " . $row["created_at"] . "</em></p>";
                echo "</div>";
            }
        } else {
            echo "Chưa có bình luận nào.";
        }

        $conn->close();
        ?>
    </div>

    <h2>Add Comment</h2>
    <form method="post" action="add_comment.php">
        <input type="hidden" name="product_id" value="1"> <!-- ID của sản phẩm -->
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" required><br>
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" required></textarea><br>
        <input type="submit" value="Submit">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>