# Task Management Application

A simple task management application with front-end and back-end functionalities.

## Front-end

The front-end of the application is implemented using `HTML, CSS, and JavaScript/jQuery` for dynamic changes. It provides the following features:

- A landing page displaying a list of tasks.
- Ability for users to add new tasks with a title, description, and due date.
- Ability for users to view detailed information of each task.
- Option to edit existing tasks.
- Option to delete tasks.
- Responsive design for usability on both desktop and mobile devices.

## Back-end

The back-end of the application is developed using `Laravel`, which provides a `RESTful API` to handle CRUD operations for tasks. It includes the following endpoints:

- `GET /api/todo` - Retrieve all tasks.
- `POST /api/todo/store` - Create a new task.
- `POST /api/todos/filter` - Retrieve a single task by its ID.
- `POST /api/tasks/update` - Update an existing task.
- `POST /api/tasks/delete` - Delete a task.

The back-end is implemented in PHP using the Laravel framework, providing a robust and scalable solution for managing tasks.

## Getting Started

To get a local copy up and running, follow these steps:
Prequisites : Install Composer, Install Apache, Install php version 7.4

1. Clone the repository:
git clone ``` https://github.com/anujs344/TaskManagement ```

2. Run Few Commands
    ``` composer install ```
    ``` npm install ```
3. Run migration
   ``` php artisan migrate ```

4.Set up the database configuration in `.env` file:

5. Run Code
   ``` php artisan serve ```



## Sample Images for Refrence
## ![ WEB APPLICATION Screenshot]
<img src="https://github.com/anujs344/TaskManagement/blob/main/photos/webApp/front_page.png" alt="Task Management App Screenshot" width="600">



<img src="https://github.com/anujs344/TaskManagement/blob/main/photos/webApp/login_page.png" alt="Task Management App Screenshot" width="600">


<img src="https://github.com/anujs344/TaskManagement/blob/main/photos/webApp/create_task.png" alt="Task Management App Screenshot" width="600">

## ![ API Endpoint Testing Screenshot]
<img src="https://github.com/anujs344/TaskManagement/blob/main/photos/Api/Finding.png" alt="Task Management App Screenshot" width="600">


<img src="https://github.com/anujs344/TaskManagement/blob/main/photos/Api/create.png" alt="Task Management App Screenshot" width="600">


<img src="https://github.com/anujs344/TaskManagement/blob/main/photos/Api/update.png" alt="Task Management App Screenshot" width="600">


## Thank You!
