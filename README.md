## Snapnet Test App

This is a very simple Laravel web application for task management. It can be used for simple stuffs such as:

-   Create task (info to save: title, description, status and due_date)
-   Edit task

Tasks are saved to a mysql table along with a Project ID.

## Prerequisites

Before you start, ensure you have the following installed:

-   Docker
-   PHP version 8.2 or later
-   Web browser
-   Shell or terminal environment

## Getting Started

1. **Clone the repository:**

    ```bash
    git clone https://github.com/degod/snapnet-test.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd snapnet-test/
    ```

3. **Install Composer dependencies:**

    ```bash
    composer install && cp .env.example .env && php artisan key:generate
    ```

4. **Start the application with Laravel Sail:**

    ```bash
    docker-compose up -d --build
    ```

5. **NPM Resource Installation:**
   Because we had to borrow some resources from viteJS, we need to run the additional code below:

    ```bash
    npm install && npm run dev
    ```

6. **Logging in to container shell on a fresh terminal:**
    - First make sure you on the project directory on this fresh terminal: `_STEP 2 ABOVE_`
    - Then run the below:

    ```bash
    docker exec -it snapnet_app bash
    ```

7. **Completing the setup:**

    ```bash
    php artisan migrate:fresh && php artisan test && php artisan db:seed
    ```

8. **Exiting container shell:**

    ```bash
    exit
    ```

9. **Accessing the application:**

-   The application should now be running on your local environment.
-   Navigate to `http://localhost:8000` in your browser to access the application.
-   To access the database, go to `http://localhost:8088/`.
    -   USER: `admin`
    -   PASS: `secret`
-   To login to the app:
    -   With the "Admin" privilege:
        -   USER: `admin@admin.com`
        -   PASS: `secretadmin`
            This should work as long as you ran the above migration code
    -   With a regular "User" privilege:
        -   USER: _[Pick a User Email from the users table in the DB]_
        -   PASS: `password`

## Contributing

If you encounter bugs or wish to contribute, please follow these steps:

-   Fork the repository and clone it locally.
-   Create a new branch (`git checkout -b feature/fix-issue`).
-   Make your changes and commit them (`git commit -am 'Fix issue'`).
-   Push to the branch (`git push origin feature/fix-issue`).
-   Create a new Pull Request against the `main` branch, tagging `@degod`.

## Contact

For inquiries or assistance, you can reach out to Godwin Uche:

-   `Email:` degodtest@gmail.com
-   `Phone:` +2348024245093
