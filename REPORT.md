# Report

The project involves designing and developing a purpose-driven website for the University of the Third Age organization. The objective was to utilize WordPress throughout the development and design phases while incorporating a continuous workflow for both development and deployment. This includes the integration of contemporary techniques and technologies.

For project management, I employed Git as the version control system for the WordPress theme and documentation and used a Trello board for monitoring tasks and its progress.

I initiated the project by configuring the local environment using Varying Vagrant Vagrants (VVV). I opted for this pre-configured Vagrant setup because it already incorporates Nginx, MariaDB, PHP, and WordPress installations. Regarding the production environment, I manually configured the LAMP (Linux, Apache, MySQL, PHP) stack on an AWS EC2 instance using Vagrant for a successful WordPress installation.

To establish the continuous deployment from the local to production environments, I utilized GitHub Actions. Using secret management and the workflow file I created in the repository, the process of pushing theme code changes to the specified directory on the production server is automatically initiated.

As for the WordPress website, I used Visual Studio Code IDE to develop the child theme based on the Twenty Twenty-Two theme. The task mainly focused on modifying the cascading style sheets (CSS).

Throughout this project, I gained valuable experience in constructing a website locally and deploying changes seamlessly to the production environment. Developing in a controlled local environment allowed experimentation without affecting the live site, ensuring everything functioned correctly. The implementation of automatic deployment was a key learning point, saving time and reducing errors, aligning with industry best practices.