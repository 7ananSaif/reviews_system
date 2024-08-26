Product Reviews App
A web application that allows users to view, add, and delete reviews for products.

Table of Contents
Introduction
Features
Installation
Usage
API Endpoints
Contributing
License
Introduction
The Product Reviews App is a web application that enables users to view, add, and delete reviews for products. This application is built using PHP, JavaScript, and a MySQL database.

Features
View existing reviews for a product
Add a new review for a product
Delete a review
Responsive design that works well on desktop and mobile devices
Installation
Clone the repository:

Copy
git clone https://github.com/7ananSaif/reviews_system.git
Create a MySQL database and configure the database connection details in the db/db-connect.php file.
Import the comments_reviews_ratings table schema into your MySQL database.
Install any necessary dependencies (e.g., PHP, Node.js, etc.).
Start the web server and navigate to the application in your web browser.
Usage
View the existing reviews for a product by visiting the appropriate page.
To add a new review, click the "Add Review" button and fill out the form.
To delete a review, click the "Delete" button for the corresponding review.
API Endpoints
The application provides the following API endpoints:

GET /api/reviews?id=<product_id>: Retrieve all reviews for a specific product.
POST /api/reviews: Add a new review for a product.
DELETE /api/reviews?id=<review_id>: Delete a specific review.
Contributing
If you would like to contribute to the Product Reviews App project, please follow these steps:

Fork the repository.
Create a new branch for your feature or bug fix.
Make your changes and test them thoroughly.
Submit a pull request with a detailed description of your changes.
License
This project is licensed under the MIT License.
