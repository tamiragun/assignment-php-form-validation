# Form validation

This was an assignment for the PHP portion of my coding bootcamp. It is a fictional form that requires validation upon submission. There are two types of validation in this project: single page validation, and validation over two pages.

**Stack used**: PHP - HTML

## The brief
These were the detailed instructions for the assignment:

**Two pages:**
- Create a multi-page form handling PHP script that parses an HTML form with the following user data and constraints. The validator should consist of two files: an HTML file with the form and a PHP file with the validation code.
    - Email (valid email address)
    - Username (6-10 characters; alphanumeric only)
    - Password (at least one lowercase letter, one uppercase letter, and one number)
    - Date of birth (after 1900, and before 2020)
    - Gender (either “male”, “female”, or “other”)
    - Address (multiple lines)
- Your script should display an appropriate error message if the user enters bad input. It should not re-render the form. You may use a combination of HTML form constraints and PHP form validation.

**Single page:**
- Do the same as above, but with a single page form handling script.
- If the user enters bad input, your script should display an error message and repopulate the form so that the user can change their
entered data.
- Note that the Password field should be exempt from repopulation. It should always be blank on every form render. 

## How to install this project
1. Clone this Github repository into a directory of your choice.
2. Within the project folder, open the two-page-form-validation.html page in your browser.
3. After playing around with that, open the one-page-form-validation.html page in your browser.
