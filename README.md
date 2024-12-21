Task Management System
Overview
The Task Management System is a web application built with Laravel. It allows Managers and Team Members to manage projects and tasks efficiently. Managers can create projects, assign tasks, and manage team members. Team Members can log in, view their assigned projects and tasks, and update task statuses.

Features
Authentication: Uses Laravel Sanctum for secure token-based authentication.
Project Management: Managers can create, update, and delete projects.
Task Management: Managers assign tasks to team members, and team members can update task statuses.
Team Management: Managers can create and manage team members, assigning them to projects.
Role-based Access Control: Middleware ensures role-based access to routes (Manager or Team Member).
User Roles
Manager:
Can register, create, and manage projects and tasks.
Can create and manage team members.
Can assign tasks to team members.
Team Member:
Can log in and view assigned projects and tasks.
Can update task statuses.
Technologies Used
Laravel: Backend framework.
Laravel Sanctum: API token authentication.
MySQL: Database for storing projects, tasks, and user data.
Blade Templates: Frontend rendering.
Database Schema
Users Table: Stores user details (email, password, role).
Projects Table: Stores project details.
Tasks Table: Stores task details (name, description, status).
Project_User Table: Pivot table to associate users with projects.
Team Table: Stores team member information.
Middleware and Role-based Access Control
Manager Middleware: Restricts access to routes for project and team member management.
Team Member Middleware: Allows access to tasks assigned to the team member.
User Flow
Manager: Registers, logs in, creates projects, assigns tasks, and manages team members.
Team Member: Logs in, views assigned projects and tasks, and updates task statuses.
Conclusion
The Task Management System provides a simple and efficient way to manage projects and tasks with role-based access. Laravel Sanctum ensures secure authentication, and middleware enforces role-based restrictions.

