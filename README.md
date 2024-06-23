# PHP School Management Application

This PHP application manages students and classes in a school environment with basic CRUD operations.

## Table of Contents

1. Basic Setup
2. Database Schema
3. Functionality
4. Styling
5. Setup Instructions

---

## 1. Basic Setup

Create a new PHP project named `school_demo`.

---

## 2. Database Schema

Create a MySQL database named `school_db` and set up the following tables:
```bash
CREATE TABLE student (
id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255),
email VARCHAR(255),
address TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
class_id INT,
image VARCHAR(255)
);

CREATE TABLE classes (
class_id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255),
created_at DATETIME
);
```
---

## 3. Functionality

### Home Page (`index.php`)

Display a list of all students with name, email, creation date, class name, and image thumbnail. Provide links to view, edit, and delete each student.

### Create Student (`create.php`)

Form to add a new student with fields for name, email, address, class (dropdown), and image upload. Validate name (required) and image format (jpg, png).

### View Student (`view.php`)

Display student details including name, email, address, class name, and image.

### Edit Student (`edit.php`)

Form pre-filled with current student data for editing name, email, address, class (dropdown), and image upload option. Validate name (required) and image format (jpg, png).

### Delete Student (`delete.php`)

Confirmation page to delete a student. Delete student record and associated image (if exists) from the server.

### Manage Classes (`classes.php`)

List all classes with options to add, edit, and delete classes.

### Image Upload Handling

Uploaded images stored in `uploads/` directory. Validate image format (jpg, png) and ensure unique filenames.

---

## 4. Styling

Basic CSS applied for visual appeal. Responsive design considerations included, utilizing frameworks like Bootstrap if desired.

---

## 5. Setup Instructions

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd school_demo

 ## 6. Screen Short

![image](https://github.com/Anubhav-Raj/School-Demo/assets/72142278/714eeb79-3851-43d4-8561-b8664c8178c0)

![image](https://github.com/Anubhav-Raj/School-Demo/assets/72142278/d8b452a2-0ae4-4712-a66c-22fc00f18077)

![image](https://github.com/Anubhav-Raj/School-Demo/assets/72142278/2ad68ce2-fb47-4e6d-93e0-8851f3e19475)

![image](https://github.com/Anubhav-Raj/School-Demo/assets/72142278/8b135752-55b7-4767-acb8-c9a7292dd903)



