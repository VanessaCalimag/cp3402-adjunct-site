# Report

The project involved the design and development of a purpose-driven website for the University of the Third Age organization. The primary objective was to leverage WordPress for both the development and design phases while implementing a continuous workflow that incorporates contemporary techniques and technologies.

## Project Management
For effective project management, Git served as the version control system for managing the WordPress theme and documentation. Additionally, a Trello board was employed to monitor tasks and track their progress.

## Development Environment
The project commenced by configuring the local development environment using Varying Vagrant Vagrants (VVV). This pre-configured Vagrant setup was chosen due to its inclusion of Nginx, MariaDB, PHP, and WordPress installations. For the production environment, an AWS EC2 instance was deployed on the Amazon Web Services platform, with Ubuntu as the preferred operating system. Essential security groups were configured, and a new Vagrantfile was created, specifying AWS credentials, instance specifications, and provisioning scripts. Package repository updates, as well as the installation of Apache, MySQL, PHP, and necessary PHP modules, were performed via SSH.

## Continuous Deployment
To establish continuous deployment from the local to production environments, GitHub Actions was utilized. Secret management and a workflow file within the repository automate the process of pushing theme code changes to the specified directory on the production server.

## WordPress Development
For the WordPress website, Visual Studio Code IDE was employed for developing the child theme based on the Twenty Twenty-Two theme. The primary focus of this task was the modification of cascading style sheets (CSS).

## Key Learnings
Throughout the project, valuable experience was gained in constructing a website locally and seamlessly deploying changes to the production environment. Working in a controlled local environment allowed for experimentation without impacting the live site, ensuring the correctness of all functionalities. The implementation of automatic deployment emerged as a pivotal learning point, resulting in time savings and error reduction, while adhering to industry best practices.

Overall, the project demonstrated effective utilization of tools and methodologies to achieve successful web development and deployment objectives.