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
   git clone [YOUR-REPO-LINK-HERE]
   cd [PROJECT-NAME]
   

2. Install PHP Dependencies
``composer install``

3. Environment Configuration
Update .env with your database details, email settings, etc.
``DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
 ``

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


### Email Logging

#### Current Implementation:
- Logs are stored in the database. You can view them through the application or directly in the database under the email_logs table.

#### Note on Best Practices:
- As per the project requirements, I've implemented email logging in the database for simplicity and demonstration purposes. However, in a production environment, storing logs directly in the database might not be the optimal approach

#### Recommended Approaches:
- File Logging is preferred for performance and data separation. Use Laravel's Monolog to log to files.
- Centralized Logging Services like ELK or Datadog offer better scalability and security.

In practice, I'd recommend moving logs out of the database for better management and security.


## API Usage
The project fetches titles from https://jsonplaceholder.typicode.com/posts for including in the reminder emails.
