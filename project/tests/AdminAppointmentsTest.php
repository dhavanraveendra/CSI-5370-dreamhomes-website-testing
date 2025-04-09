<?php
use PHPUnit\Framework\TestCase;  // Make sure to include this line to import TestCase

require_once __DIR__ . '/../admin_appointment_handler.php';

class AdminAppointmentsTest extends TestCase
{
    private $conn;  // Declare the $conn property explicitly
    private $testEmail = 'phpunit_test@example.com';
    private $testPhone = '9999999999';

    protected function setUp(): void
    {
        // Create a new connection to the database for testing
        $this->conn = new mysqli('localhost', 'root', 'Dhavan@29', 'lnd_db');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function testInsertAppointmentWithValidDate(): void
    {
        $testData = [
            'name' => 'PHPUnit Tester',
            'email' => $this->testEmail,
            'phone_number' => $this->testPhone,
            'date' => '2025-04-10',  // Future date
            'time' => '10:00',
            'query' => 'Interested in property viewing.',
            'P_no' => '1021',
            'A_Id' => '5053'
        ];

        // Call the function to insert the appointment
        $result = insertAppointment($this->conn, $testData);

        // Assert that the result is true (indicating a successful insert)
        $this->assertTrue($result);

        // Check if the appointment was actually inserted into the database
        $res = mysqli_query($this->conn, "SELECT * FROM `Appointment` WHERE email = '{$this->testEmail}' AND phone_number = '{$this->testPhone}'");

        // Assert that there is at least one result (appointment inserted)
        $this->assertGreaterThan(0, mysqli_num_rows($res));
    }

    public function testInsertAppointmentWithPastDate(): void
    {
        $testData = [
            'name' => 'PHPUnit Tester',
            'email' => $this->testEmail,
            'phone_number' => $this->testPhone,
            'date' => '2024-04-01',  // Past date
            'time' => '10:00',
            'query' => 'Interested in property viewing.',
            'P_no' => '1021',
            'A_Id' => '5053'
        ];

        // Call the function to insert the appointment
        $result = insertAppointment($this->conn, $testData);

        // Assert that the result is false (indicating a failed insert because the date is in the past)
        $this->assertFalse($result);

        // Check if the appointment was inserted into the database
        $res = mysqli_query($this->conn, "SELECT * FROM `Appointment` WHERE email = '{$this->testEmail}' AND phone_number = '{$this->testPhone}'");

        // Assert that there are no results (appointment should not be inserted)
        $this->assertEquals(0, mysqli_num_rows($res));
    }

    protected function tearDown(): void
    {
        // Clean up by deleting the test data
        mysqli_query($this->conn, "DELETE FROM `Appointment` WHERE email = '{$this->testEmail}' AND phone_number = '{$this->testPhone}'");

        // Close the database connection
        $this->conn->close();
    }
}
?>