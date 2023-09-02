# Project Overview

## Introduction
This repository houses a WordPress child theme based on Twenty Twenty-Two, tailored specifically for the University of the Third Age organization's needs.

## Theme Development
Built on the theme: Twenty Twenty Two

### Features
Intuitive
- The objective for the theme is to design a straightforward user interface that facilitates effortless navigation, resulting in a user-friendly and intuitive experience.
- The theme utilizes large font sizes to ensure the website is readable by the targeted audience.

Custom Logo
- A personalized logo that can be incorporated into the header. It can be configured and tailored via the site identity settings.

Page Customization
- Ability to modify the layout, structure, and visual elements of a page.
- Customize the visual style of a page, such as colors, fonts, typography, and spacing.
- Add, remove, or reorganize content on a page.

Header Customization
- A main navigation menu can be placed in the header location suitable for intended audience.

### Continued Development
Footer Navigation
- Can add secondary navigation menu in the footer.

Addition Site Pages
- Header and Footer - unablet to further customize even after adding template parts from the parent theme
- Newsletter
- Forum for enhanced user engagement

## Deployment Workflow

### Technologies Used
- CMS: `WordPress`
- Local Environment: `Varying Vagrant Vagrants`
- Production Environment: `Vagrant in AWS EC2 Instance`
- Project Management Board: `Trello`
- Version Control: `GitHub`
- Deployment Workflow: `GitHub Actions`
- Website Migration: `WPVivid Plugin`

### Local Environment 
Varying Vagrant Vagrants is primarily chosen due to its preconfigured services such as Nginx, PHP, and MariaDB (or MySQL) that are commonly used in WordPress hosting environments. These services are set up to work optimally with WordPress.

Set up:
1. Prerequisite Installations: Vagrant, Git, Virtual Box 
2. Visit the official website in [Varying Vagrant Vagrants](https://varyingvagrantvagrants.org/) for detailed instructions of VVV installation.

### Production Environment
Vagrant possesses the capability to oversee various machine types beyond its default functionality. This is achieved by integrating additional providers with Vagrant such as AWS.

Set up:
1. Prerequisite Installations: Vagrant, Putty and PuttyGen SSH Client 
2. Create and setup an AWS Account
3. Setup an access key in AWS
4. Create a new Key Pair:
   - First create SSH keys using PuTTYgen
5. In AWS:
   - Setup a Security Group in AWS
   - Choose an Image (to use as the base of machine/instance you spinning up)
6. Prepare Vagrant:
   - Install the AWS provider plugin
   - Add the dummy box using any name
   - Setup environment variables for AWS_ACCESS_KEY & AWS_SECRET_KEY
   - Setup the Vagrantfile
7. Launch the Instance in AWS

Detailed instructions to set up Vagrant with AWS in https://melissapalmer.github.io/devops/2018/08/16/vagrant-windows-aws.html

### Project Management Board
Trello - collaboration tool that uses a system of boards, lists, and cards to help the team organize and manage tasks and projects.

Register to [Trello](https://trello.com/home) and join the team to get access to the board detailing the project/s.

### Version Control
Version control workflow in Github involves tracking and managing changes to the code and collaborating with others effectively.

Set up:
1. Initialize a version control system (e.g., Git) within your VVV project directory if it's not already initialized. Run the following commands in your project directory:
   - `git init`
   - `git add .`
   - `git commit -m "Initial commit"`
2. Link the local repository to the GitHub repository:
   - `git remote add origin <repository_url>`
   - `git branch -M master`
   - `git push -u origin master`
3. Regularly commit your changes using Git:
   - `git add .`
   - `git commit -m "Description of changes"`
4. To sync your local changes with the GitHub repository, push your commits to GitHub:
   - `git push origin main`
5. If others have pushed changes to the GitHub repository, you can pull these changes into your local environment:
   - `pull origin master`

### Website Migration: WPVivid Plugin
Note: WPVivid Plugin must be installed and activated on both local and production WordPress

1. On the Target (New) Website:
   - Generate Key from the Key tab
   - Copy the key
2. On the Source (Original) Website:
   - Paste the key to the space provided under Auto-Migration tab and save
   - Click on 'Clone the Transfer'
   - Wait until file/s are ready
3. On the Target (New) Website:
   - From Backup &Restore tab click 'scan uploaded backup or received backup'
   - Click restore