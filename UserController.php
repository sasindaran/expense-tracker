<?php
// UserController.php - Handles user-related requests

include_once 'UserModel.php'; // Include the UserModel

class UserController {
    private $userModel;

    // Constructor to initialize the UserModel
    public function __construct() {
        $this->userModel = new UserModel(); // Create an instance of UserModel
    }

    // Method to handle user registration
    public function register($username, $email, $password) {
        if (empty($username) || empty($email) || empty($password)) {
            return "All fields are required!";
        }

        // Call the model to register the user
        $result = $this->userModel->registerUser($username, $email, $password);

        if ($result) {
            return "Registration successful!";
        } else {
            return "Username or email already exists!";
        }
    }
}
?>
