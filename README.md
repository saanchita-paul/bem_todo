# Laravel Todo List with Email Reminders

## Project Overview
This project is a simple Todo List application built with Laravel 11, featuring CRUD operations for todo items, email reminders, and integration with an external API.

## Features
- **CRUD Operations** for todo items with date and time.
- **Email Reminders** sent 10 minutes before the todo deadline.
- **API Integration** to fetch random titles from an external source.
- **Email Logging** to keep track of all emails sent through the application.
- **Notification Tags** for todos after email notifications are sent.
- Utilizes **Route Model Binding**, **Scheduler**, and **Queue** for optimal performance.

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or another database supported by Laravel
- Node.js (for npm)

### Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/saanchita-paul/bem_todo.git
   cd bem_todo
   

2. Install PHP Dependencies
``composer install``

3. Environment Configuration
Update .env with your database details, email settings, etc.
```
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
```

4. Generate Application Key

``php artisan key:generate``

5. Run Migrations
``php artisan migrate``

6. Install Frontend Dependencies

``npm install
npm run dev``

7. Start Development Server

``php artisan serve``


### Usage
- Create a Todo: Visit /todos/create to add a new todo with a deadline.
- View Todos: Navigate to /todos to see all todos.
- Edit Todos: /todos/{id}/edit to edit a specific todo.
- View Todos: todos/{id} to view a specific todo.
- Delete Todos: todos/{id} to delete a specific todo.

### Scheduler and Queue
- The scheduler for email reminders is set within routes\console.php. Run the scheduler command:
``php artisan schedule:work``

- For queue processing, you'll need to run:
``php artisan queue:work``



## API Usage
The project fetches titles from https://jsonplaceholder.typicode.com/posts for including in the reminder emails.

k
## Future Enhancement: 

### Pagination for Todo List
Currently, all todos are loaded on a single page, which may not be efficient as the data grows.

#### Possible Approach:
- Implement Laravel’s built-in pagination for optimized data handling.
- Ensure pagination is applied to both the backend (query limits) and frontend (UI updates).

Provide navigation links for easy browsing.

### File Cleanup Scheduler
Currently, CSV files are stored in storage/app, which may accumulate over time. In the future, we can implement a Laravel scheduler to automatically delete old CSV files, optimizing storage usage.

#### Possible Approach:
- Create an Artisan command to remove CSV files older than a specified duration (e.g., 24 hours).
- Schedule the command to run daily via Laravel's task scheduler.
- Log deletions for tracking and monitoring.

This will ensure efficient file management without manual cleanup. 


### Email Logging Optimization
Currently, Email logs are stored in the database (email_logs table) for easy access and demonstration.

#### Recommended Improvements:
- File Logging: Use Laravel’s Monolog to log emails in files for better performance.
- Centralized Logging: Integrate with services like ELK or Datadog for scalability and security.

Moving email logs out of the database will enhance performance, simplify management, and improve security.

### Frontend with Vue.js
The project currently uses Laravel's Blade for the frontend, as Vue.js was not specified in the requirements.

#### Recommended Improvement:
- Vue.js for a More Dynamic UI: Replacing or integrating Vue.js with Blade can enhance interactivity and responsiveness.
- Better User Experience: Vue.js enables features like real-time updates, improved form handling, and smoother navigation.

Blade is efficient for server-side rendering, but Vue.js enhances maintainability and UX.
