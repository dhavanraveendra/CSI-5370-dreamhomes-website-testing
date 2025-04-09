<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../admin_property_listing_form.php';

class AdminPropertyListingFormTest extends TestCase
{
    private $conn;  // Declare the $conn property explicitly
    private $testCity = 'Test City';
    private $testAddress = '123 Test Address';
    private $testPrice = '100000';
    private $testArea = '1500';
    private $testImage = 'test_image.jpg';
    private $testA_Id = '5053';
    private $testDescription = 'Test property description';

    protected function setUp(): void
    {
        // Create a new connection to the database for testing
        $this->conn = new mysqli('localhost', 'root', 'Dhavan@29', 'lnd_db');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function testInsertPropertyWithValidData(): void
    {
        $testData = [
            'city' => $this->testCity,
            'address' => $this->testAddress,
            'p_type' => 'House',
            'p_status' => 'Available',
            'no_bedroom' => '3',
            'no_bathroom' => '2',
            'furnished' => 'Furnished',
            'image' => $this->testImage,
            'area' => $this->testArea,
            'price' => $this->testPrice,
            'movein_date' => '2025-05-01',
            'listing_date' => '2025-04-08',
            'A_Id' => $this->testA_Id,
            'description' => $this->testDescription
        ];

        // Mock the $_POST and $_FILES data
        $_POST = $testData;
        $_FILES['image'] = [
            'name' => $this->testImage,
            'size' => 500000,
            'tmp_name' => '/tmp/test_image.jpg',
            'error' => 0
        ];

        // Simulate form submission and call the insert query function
        $result = $this->insertProperty($testData);

        // Assert that the insert was successful
        $this->assertTrue($result);

        // Verify if the data has been inserted into the database
        $res = mysqli_query($this->conn, "SELECT * FROM `Property` WHERE city = '{$this->testCity}' AND address = '{$this->testAddress}'");

        // Assert that the property is inserted
        $this->assertGreaterThan(0, mysqli_num_rows($res));
    }


    public function testInsertPropertyWithInvalidImageType(): void
    {
        $testData = [
            'city' => $this->testCity,
            'address' => $this->testAddress,
            'p_type' => 'House',
            'p_status' => 'Available',
            'no_bedroom' => '3',
            'no_bathroom' => '2',
            'furnished' => 'Furnished',
            'image' => 'invalid_file.txt',  // Invalid image file type
            'area' => $this->testArea,
            'price' => $this->testPrice,
            'movein_date' => '2025-05-01',
            'listing_date' => '2025-04-08',
            'A_Id' => $this->testA_Id,
            'description' => $this->testDescription
        ];

        // Mock the $_POST data
        $_POST = $testData;
        $_FILES['image'] = [
            'name' => 'invalid_file.txt',
            'size' => 500000,
            'tmp_name' => '/tmp/invalid_file.txt',
            'error' => 0
        ];

        // Simulate form submission
        $result = $this->insertProperty($testData);

        // Assert that the insert failed due to invalid image type
        $this->assertFalse($result);

        // Check if the property was not inserted
        $res = mysqli_query($this->conn, "SELECT * FROM `Property` WHERE city = '{$this->testCity}' AND address = '{$this->testAddress}'");
        $this->assertEquals(0, mysqli_num_rows($res));
    }

    public function testInsertPropertyWithFutureMoveInDate(): void
    {
        $testData = [
            'city' => $this->testCity,
            'address' => $this->testAddress,
            'p_type' => 'House',
            'p_status' => 'Available',
            'no_bedroom' => '3',
            'no_bathroom' => '2',
            'furnished' => 'Furnished',
            'image' => $this->testImage,
            'area' => $this->testArea,
            'price' => $this->testPrice,
            'movein_date' => '2025-06-01',  // Future move-in date
            'listing_date' => '2025-04-08',
            'A_Id' => $this->testA_Id,
            'description' => $this->testDescription
        ];

        // Mock the $_POST data
        $_POST = $testData;
        $_FILES['image'] = [
            'name' => $this->testImage,
            'size' => 500000,
            'tmp_name' => '/tmp/test_image.jpg',
            'error' => 0
        ];

        // Simulate form submission
        $result = $this->insertProperty($testData);

        // Assert that the insert was successful (move-in date is in the future, which should be valid)
        $this->assertTrue($result);

        // Verify if the data has been inserted into the database
        $res = mysqli_query($this->conn, "SELECT * FROM `Property` WHERE city = '{$this->testCity}' AND address = '{$this->testAddress}'");

        // Assert that the property is inserted
        $this->assertGreaterThan(0, mysqli_num_rows($res));
    }
    


    private function insertProperty($data): bool
    {
        // Mock the insert query (you can move the actual database insertion code here)
        $query = "INSERT INTO `Property` (`city`, `address`, `p_type`, `p_status`, `no_bedroom`, `no_bathroom`, `furnished`, `image`, 
                    `area`, `price`, `movein_date`, `listing_date`, `A_Id`, `description`) 
                  VALUES ('{$data['city']}', '{$data['address']}', '{$data['p_type']}', '{$data['p_status']}', '{$data['no_bedroom']}', 
                    '{$data['no_bathroom']}', '{$data['furnished']}', '{$data['image']}', '{$data['area']}', '{$data['price']}', 
                    '{$data['movein_date']}', '{$data['listing_date']}', '{$data['A_Id']}', '{$data['description']}')";
        
        $result = mysqli_query($this->conn, $query);
        
        if (!$result) {
            return false;  // Return false if the insert failed
        }

        // Move the uploaded file to its intended folder
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploaded_img/' . $_FILES['image']['name']);
        return true;  // Return true if insertion is successful
    }

    protected function tearDown(): void
    {
        // Clean up by deleting the test property data from the database
        mysqli_query($this->conn, "DELETE FROM `Property` WHERE city = '{$this->testCity}' AND address = '{$this->testAddress}'");

        // Close the database connection
        $this->conn->close();
    }
}
?>