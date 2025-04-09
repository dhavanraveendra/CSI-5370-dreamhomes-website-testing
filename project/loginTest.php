<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $conn;
    private $testEmail = 'phpunit_test@example.com';
    private $testPassword = 'testpassword123';

    protected function setUp(): void
    {
        $this->conn = new mysqli('localhost', 'root', 'Dhavan@29', 'lnd_db');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Insert a test user into the database, with user_type set to 'User'
        $hashedPassword = md5($this->testPassword);
        $name = 'PHPUnit Test User'; 
        $userType = 'User'; // Set user_type to 'User'
        mysqli_query($this->conn, "INSERT INTO User (name, email, password, user_type) VALUES ('$name', '$this->testEmail', '$hashedPassword', '$userType')");
    }

    public function testLoginValidCredentials()
    {
        // Start output buffering to prevent headers from sending prematurely
        ob_start();

        // Simulate a form submission
        $_POST['email'] = 'phpunit_test@example.com';
        $_POST['password'] = 'testpassword123';

        // Simulate the login script execution
        include 'login.php'; // Make sure the login.php script triggers the header

        // Check if the correct location header is set
        $this->assertContains('Location: home.php', xdebug_get_headers());

        // Clean up output buffering
        ob_end_clean(); // This will clean up the output buffer after the test
    }

    public function testLoginInvalidCredentials(): void
    {
        // Start output buffering to capture the output
        ob_start();

        // Simulate POST request to login.php with invalid credentials
        $_POST['email'] = 'invalid@example.com';
        $_POST['password'] = 'wrongpassword';
        $_POST['submit'] = 'login now';

        // Include the login.php file to execute the logic
        include 'login.php';

        // Capture the output buffer
        $output = ob_get_clean();

        // Assert that the error message appears in the output
        $this->assertStringContainsString('incorrect email or password!', $output);

        // Clean up output buffering
        ob_end_clean(); // This will clean up the output buffer after the test
    }

    protected function tearDown(): void
    {
        // Clean up by deleting the test user from the database
        mysqli_query($this->conn, "DELETE FROM User WHERE email = '{$this->testEmail}'");

        // Close the database connection
        $this->conn->close();
    }
}
?>