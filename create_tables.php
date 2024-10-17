<?php 
    include "db_connection.php";

    // create admin table
    $sql = "CREATE TABLE `admin` (
        admin_id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(50),
        pass VARCHAR(255),
        avatar VARCHAR(100),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );";

    // create student table
    $sql .= "CREATE TABLE students (
        student_id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        admin_id INT(2) UNSIGNED,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(50),
        pass VARCHAR(225),
        avatar VARCHAR(100),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (admin_id) REFERENCES `admin`(admin_id)
    );";
    
    // create quiz table
    $sql .= "CREATE TABLE quizzes (
        quiz_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        admin_id INT(2) UNSIGNED,
        title VARCHAR(50) NOT NULL,
        time_allowed TIME NOT NULL,
        attempts INT(1),
        number_of_questions INT(3),
        `start_date` DATETIME NOT NULL,
        `end_date` DATETIME NOT NULL,
        FOREIGN KEY (admin_id) REFERENCES `admin`(admin_id)
    );";

    // create question table
    $sql .= "CREATE TABLE questions (
        question_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        quiz_id INT(6) UNSIGNED,
        question VARCHAR(255) NOT NULL,
        `type` VARCHAR(20) NOT NULL,
        `point` INT(3) NOT NULL,
        FOREIGN KEY (quiz_id) REFERENCES quizzes(quiz_id)
    );";

    // create answer table
    $sql .= "CREATE TABLE answers (
        answer_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        question_id INT(10) UNSIGNED,
        answer VARCHAR(150) NOT NULL,
        FOREIGN KEY (question_id) REFERENCES questions(question_id)
    );";

    // create result table
    $sql .= "CREATE TABLE results (
        result_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        quiz_id INT(6) UNSIGNED,
        student_id INT(7) UNSIGNED,
        score INT(3) NOT NULL,
        FOREIGN KEY (quiz_id) REFERENCES `quizzes`(quiz_id),
        FOREIGN KEY (student_id) REFERENCES `students`(student_id)
    );";

    // create student_takes_quiz table
    $sql .= "CREATE TABLE students_take_quizzes (
        quiz_id INT(6) UNSIGNED,
        student_id INT(7) UNSIGNED,
        progress VARCHAR(20) NOT NULL,
        attempts_made INT(1) NOT NULL,
        final_highest_score INT(3) NOT NULL,
        PRIMARY KEY (student_id, quiz_id),
        FOREIGN KEY (quiz_id) REFERENCES `quizzes`(quiz_id),
        FOREIGN KEY (student_id) REFERENCES `students`(student_id)
    );";

    // Execute query
    $conn = OpenCon();
    
    if ($conn->multi_query($sql) === TRUE) {
        $message = "Table  created successfully";
    } else {
        $message = "Error creating table: " . $conn->error;
    }


    // update on creating tables
    echo $message;
    // Close connection
    CloseCon($conn);

?>