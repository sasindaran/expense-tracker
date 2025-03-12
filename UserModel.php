<?php
// UserModel.php - Handles user-related database operations

include_once 'db.php'; // Include the database connection

class UserModel {
    private $db;

    // Constructor to initialize the DB connection
    public function __construct() {
        $this->db = Database::getInstance(); // Get the single DB instance
    }

    // Method to register a new user
    public function registerUser($username, $email, $password) {
        // Check if the username or email already exists
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return false; // Username or email already exists
        }

        // Insert the new user into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($insertQuery);
        $stmt->bind_param('sss', $username, $email, $hashedPassword);
        $stmt->execute();

        return true; // User successfully registered
    }
}
?>
