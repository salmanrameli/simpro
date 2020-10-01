# SIMPRO
Sistem Informasi Monitoring Proyek / Project Management Information System

## Explanation
Built based on feedbacks from my field supervisor during internship at BRI Primary Satellite Control Facility. The web applications offers several features such as:
- Ability to create new project and add personnel members to the project.
- Add and edit subtasks for the project.
- Show overall project’s progress based on the subtasks done and on-progress ratio.
- Change subtasks status between To-Do, In-Progress, Finished, and Revision (a la Bitrix24 Kanban board).
- Upload & download files in the project page.

## Installation
1. Download then extract the program.
2. `cd` inside extracted folder (default folder name is simpro).
3. Run `composer install` to install dependencies.
4. Run `cp .env.example .env` then change the relevant .env parameters, e.g. DB_HOST, DB_PORT, etc.
5. Run `php artisan migrate` to migrate tables to database.
6. Run `php artisan db:seed` to fill the tables with dummy data - this step is optional.
    - You can log in to the application with personnel id of '1' to '25' with password 'password'

## Several Screenshots of the App

##### Login
![Login](https://raw.githubusercontent.com/salmanrameli/simpro/master/login.png)

##### Dashboard
![Dashboard](https://raw.githubusercontent.com/salmanrameli/simpro/master/dashboard.png)

##### List of Users
![List User](https://raw.githubusercontent.com/salmanrameli/simpro/master/list-user.png)

##### Add New User
![Add User](https://raw.githubusercontent.com/salmanrameli/simpro/master/add-user.png)

##### List of Projects
![List Kegiatan](https://raw.githubusercontent.com/salmanrameli/simpro/master/list-kegiatan.png)

##### Add New Project
![Tambah Kegiatan](https://raw.githubusercontent.com/salmanrameli/simpro/master/kegiatan-tambah.png)

##### Project Detail
![Detail Kegiatan](https://raw.githubusercontent.com/salmanrameli/simpro/master/detail-kegiatan.png)

##### Add Project's Subtask Modal
![Tambah Subtask](https://raw.githubusercontent.com/salmanrameli/simpro/master/subtask-tambah.png)

##### List of Project's Members
![List Anggota Kegiatan](https://raw.githubusercontent.com/salmanrameli/simpro/master/kegiatan-pic.png)

##### Upload Document
![Upload Dokumen](https://raw.githubusercontent.com/salmanrameli/simpro/master/kegiatan-upload.png)

##### List of Project's Uploaded Documents
![List Dokumen Kegiatan](https://raw.githubusercontent.com/salmanrameli/simpro/master/kegiatan-dokumen.png)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
