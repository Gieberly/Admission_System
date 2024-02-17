<?php

// Include the function to add a table
include 'add_table_function.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $tableName = $_POST["tableName"];

    // Define pre-determined columns
    $columns = array(
        'id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
        'id_picture LONGBLOB NOT NULL',
        'applicant_name VARCHAR(50) NOT NULL',
        'gender VARCHAR(10) NOT NULL',
        'birthdate DATE NOT NULL',
        'birthplace VARCHAR(100) NOT NULL',
        'age INT(11) NOT NULL',
        'civil_status VARCHAR(20) NOT NULL',
        'citizenship VARCHAR(50) NOT NULL',
        'nationality VARCHAR(50) NOT NULL',
        'permanent_address VARCHAR(50) NOT NULL',
        'zip_code INT(4) NOT NULL',
        'phone_number VARCHAR(20) DEFAULT NULL',
        'facebook VARCHAR(255) NOT NULL',
        'email VARCHAR(25) NOT NULL',
        'contact_person_1 VARCHAR(50) NOT NULL',
        'contact1_phone VARCHAR(50) NOT NULL',
        'relationship_1 VARCHAR(10) NOT NULL',
        'contact_person_2 VARCHAR(50) DEFAULT NULL',
        'contact_person_2_mobile VARCHAR(50) DEFAULT NULL',
        'relationship_2 VARCHAR(10) DEFAULT NULL',
        'academic_classification VARCHAR(50) NOT NULL',
        'high_school_name_address VARCHAR(50) NOT NULL',
        'lrn VARCHAR(12) NOT NULL',
        'degree_applied VARCHAR(100) NOT NULL',
        'nature_of_degree VARCHAR(25) NOT NULL',
        'applicant_number VARCHAR(20) NOT NULL',
        'application_date DATE NOT NULL',
        'english_grade DECIMAL(5,2) DEFAULT NULL',
        'english_2 VARCHAR(255) DEFAULT NULL',
        'english_3 VARCHAR(255) DEFAULT NULL',
        'math_grade DECIMAL(5,2) DEFAULT NULL',
        'math_2 VARCHAR(255) DEFAULT NULL',
        'math_3 VARCHAR(255) DEFAULT NULL',
        'science_grade DECIMAL(5,2) DEFAULT NULL',
        'science_2 VARCHAR(255) DEFAULT NULL',
        'science_3 VARCHAR(255) DEFAULT NULL',
        'gwa_grade DECIMAL(5,2) DEFAULT NULL',
        'Result VARCHAR(255) DEFAULT NULL',
        'status ENUM("Accepted","Declined","Cancelled") DEFAULT NULL',
        'appointment_date DATE DEFAULT NULL',
        'appointment_time TIME DEFAULT NULL',
        'appointment_status ENUM("Accepted","Declined","Cancelled") DEFAULT NULL'
    );
    // Add table to the database
    addTableToDatabase($tableName, $columns);
}

?>
