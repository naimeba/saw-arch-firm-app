# SAW Architecture Firm App

Web application developed for an architecture firm.

The project was created as part of a web development course and allows visitors to discover architecture projects while providing authenticated users with access to blog publishing and profile management features.

The application is containerized using Docker Compose and runs with separate services for Nginx, PHP, MySQL and phpMyAdmin.

---

# Project Overview

The goal of this project is to provide a simple architecture firm website where:

* visitors can browse information and blog articles
* registered users can access their account
* authenticated users can publish content
* administrators can manage the application's data through MySQL

In addition to the web development aspects, the project is also used to practice containerized environments with Docker.

---

# Features

## Visitor Features

Visitors can:

* Browse the website
* Read blog articles
* Search articles using keywords
* View architecture-related content

## Registered User Features

Authenticated users can:

* Log in
* Log out
* View their profile
* Update profile information
* Change password
* Create blog articles
* Publish content

---

# Technologies

## Backend

* PHP
* MySQL

## Frontend

* HTML
* CSS
* JavaScript
* AJAX

## Infrastructure

* Docker
* Docker Compose
* Nginx
* PHP-FPM
* phpMyAdmin

---

# Application Architecture

The application is composed of multiple services running in separate containers.

```text
Browser
   |
   v
 Nginx
   |
   v
PHP-FPM
   |
   v
 MySQL
```

Database administration is available through phpMyAdmin:

```text
Developer
   |
   v
phpMyAdmin
   |
   v
 MySQL
```

---

# Docker Services

| Service    | Purpose                                |
| ---------- | -------------------------------------- |
| nginx      | Web server and application entry point |
| php        | Executes PHP application code          |
| mysql      | Stores application data                |
| phpmyadmin | Database administration interface      |

---

# Project Structure

```text
saw-arch-firm-app/
├── docker-compose.yml
├── .env.example
├── mysql/
├── nginx/
├── php/
├── public/
└── README.md
```

---

# Database Structure

The application uses two main tables.

## Users Table

Stores user information:

* User ID
* First name
* Last name
* Email
* Password

Users can:

* Register
* Authenticate
* Update their profile
* Change their password

## Blog Table

Stores published articles:

* Article ID
* Keywords
* Content
* Publication date

The search feature uses article content and keywords to retrieve relevant posts.

---

# Responsive Design

The user interface is responsive and adapts to different screen sizes using:

* CSS Media Queries
* Flexible layouts
* Mobile-friendly navigation

---

# Dynamic Features

The project uses JavaScript and AJAX to provide a better user experience by updating some content dynamically without requiring a full page reload.

---

# Prerequisites

Before running the application, install:

* Docker
* Docker Compose

Verify installation:

```bash
docker --version
docker compose version
```

---

# Environment Variables

Create a local environment file from the example configuration:

```bash
cp .env.example .env
```

Example:

```env
MYSQL_DATABASE=saw_arch_firm
MYSQL_USER=saw_user
MYSQL_PASSWORD=saw_password
MYSQL_ROOT_PASSWORD=root_password
```

The `.env` file should not be committed to GitHub.

---

# Running the Project

Start all services:

```bash
docker compose up -d
```

Check container status:

```bash
docker compose ps
```

Stop the application:

```bash
docker compose down
```

Remove containers and database volume:

```bash
docker compose down -v
```

---

# Access URLs

Application:

```text
http://localhost
```

phpMyAdmin:

```text
http://localhost:8585
```

Use the database credentials configured in your `.env` file.

---
## CI/CD

This project includes a simple GitHub Actions workflow.

The pipeline runs automatically on each push or pull request to the `main` branch.

It checks that:

- the repository can be cloned
- the environment file can be created from `.env.example`
- the Docker Compose configuration is valid
- the Docker containers can be built
- the application stack can start successfully

This is a first step toward a complete CI/CD process.

# DevOps Learning Objectives

This project allowed me to practice:

* Docker containerization
* Multi-container applications with Docker Compose
* Service separation
* Nginx configuration
* PHP-FPM integration
* MySQL administration
* Environment variable management
* Technical documentation
* GitHub Actions CI pipeline

---

# Future Improvements

Possible future enhancements include:

* Automated testing
* HTTPS configuration
* Improved secret management
* Health checks for containers
* Database backups
* Monitoring and logging

---

# Security Notes

This project was developed as a learning project.

Future security improvements could include:

* Replacing MD5 password hashing with `password_hash()` and `password_verify()`
* Improved input validation
* Stronger password policies
* HTTPS deployment
* Better secret management

---

# License

GPL-2.0 License
