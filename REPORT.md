# Report

The project involved the design and development of a purpose-driven website for the University of the Third Age organization. The primary objective was to leverage WordPress for both the development and design phases while implementing a continuous workflow that incorporates contemporary techniques and technologies.

## Project Management
Git was chosen as the version control system to oversee the management of both the WordPress theme and project documentation. Git repositories were created to house all project-related files, allowing for collaborative development and efficient tracking of changes.
Trello boards were instrumental in organizing and monitoring project tasks. Multiple cards on a single board were set up to categorize tasks by type, such as development, local environment, production management, etc.

## Development Environment
The project initiation involved the setup of the local development environment using Varying Vagrant Vagrants (VVV). VVV was selected for its pre-configured Vagrant environment, which included essential components like Nginx, MariaDB, PHP, and WordPress installations. This choice expedited the development process by providing a robust foundation for testing and coding tasks.
For the production environment, an Amazon Web Services (AWS) EC2 instance was deployed, with Ubuntu serving as the preferred operating system. To ensure security and access control, essential security groups were meticulously configured. Additionally, a new Vagrantfile was generated, specifying AWS credentials, instance specifications, and provisioning scripts. This Vagrantfile served as the blueprint for setting up the production environment.
The configuration and updates required for the production environment were executed via SSH. This included updating package repositories and installing crucial components such as Apache, MySQL, PHP, and the necessary PHP modules. 

## Continuous Deployment
Continuous deployment from the local development environment to the production environment was established using GitHub Actions. This automated workflow streamlined the deployment process, ensuring that code changes to the WordPress theme were seamlessly propagated to the production server.
GitHub Actions leveraged secret management to securely handle sensitive information such as SSH keys and server credentials. Within the project's repository, a customized workflow file was configured to orchestrate the deployment procedure. This workflow file contained the necessary instructions and triggers to initiate the deployment process whenever theme code changes were pushed to the repository.
Through this automated setup, the entire deployment pipeline, from code changes to their deployment in the specified directory on the production server, was efficiently managed and executed, reducing manual intervention and enhancing deployment reliability.

## WordPress Development
The development of the WordPress website centered on utilizing the Visual Studio Code (VS Code) integrated development environment (IDE) for building a child theme derived from the Twenty Twenty-Two theme. VS Code was chosen for its efficiency and flexibility in WordPress theme development.
The primary objective of this development task was the modification of cascading style sheets (CSS). Through VS Code, CSS files were accessed and edited, allowing for fine-tuning of the website's visual presentation and layout.

## Key Learnings
Throughout the project, valuable experience was gained in constructing a website locally and seamlessly deploying changes to the production environment. Working in a controlled local environment allowed for experimentation without impacting the live site, ensuring the correctness of all functionalities. The implementation of automatic deployment emerged as a pivotal learning point, resulting in time savings and error reduction, while adhering to industry best practices.

Overall, the project demonstrated effective utilization of tools and methodologies to achieve successful web development and deployment objectives.