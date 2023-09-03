# Job Board - Laravel App

A simple job board application built using Laravel 10 and TailwindCSS. It allows users to access a list of job listings, register, and sign in as either job seekers or employers. Job seekers can apply for jobs and track their application status, while employers can create company profiles and list new job openings.

## Features 🚀

✅ Browse a comprehensive list of job listings with advanced filtering options.

✅ User registration and authentication system.

✅ Job seekers can apply for jobs, specify expected salary, and upload their CV.

✅ View the number of applicants for each job listing.

✅ See the average expected salary of applicants for a specific job.

✅ Check if a job offer is still open or has been closed.

✅ Employers can register, create company profiles, and list new job openings.

✅ Employers can edit and close job listings.

✅ Employers can view and download job applications.

## Screenshots 🖼️

![alt text](https://github.com/joaocba/laravel-job-board/blob/main/screenshots/job-board-joblist.png?raw=true)

![alt text](https://github.com/joaocba/laravel-job-board/blob/main/screenshots/job-board-login.png?raw=true)

![alt text](https://github.com/joaocba/laravel-job-board/blob/main/screenshots/job-board-jobapply.png?raw=true)

![alt text](https://github.com/joaocba/laravel-job-board/blob/main/screenshots/job-board-myapplications.png?raw=true)

![alt text](https://github.com/joaocba/laravel-job-board/blob/main/screenshots/job-board-myjobs.png?raw=true)

![alt text](https://github.com/joaocba/laravel-job-board/blob/main/screenshots/job-board-editjob.png?raw=true)

## Usage 🛠️

Follow these steps to get the project up and running on your local machine:

1. Clone the repository.

2. Install Composer dependencies:
   ```bash
   composer install
   ```

3. Configure your `.env` file with your database settings.

4. Run database migrations:
   ```bash
   php artisan migrate
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

6. Access the application in your web browser at `http://localhost:8000`.

Please ensure that you have NPM installed and TailwindCSS. You can compile your assets by running the following command:

```bash
npm run dev
```

## Contributing 🤝

Contributions are welcome! If you'd like to contribute to this project, please create a pull request for enhancements or bug fixes. Feel free to open issues for feature requests or to report any problems you encounter.

## License 📝

This project is licensed under the [MIT License](insert_license_link_here).
