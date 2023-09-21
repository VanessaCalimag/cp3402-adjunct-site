# Project Overview

## Introduction
This repository houses a WordPress child theme based on Twenty Twenty-Two, tailored specifically for the University of the Third Age organization's needs.

## Theme Development
Built on the theme: Twenty Twenty Two

### Features
Intuitive
- The objective for the theme is to design a straightforward user interface that facilitates effortless navigation, resulting in a user-friendly and intuitive experience.
- The theme utilizes large font sizes to ensure the website is readable by the targeted audience.

Custom logo
- A personalized logo that can be incorporated into the header. It can be customized under the theme's appearance in templates section.
	- Navigate to templates > pages 
	- Click on edit button
	- Locate the block containing logo 
	- Add or replace the the logo and adjust settings

Page Customization
- Ability to modify the layout, structure, and visual elements of a page. 
   - Featured Image (E.g. Home page)
      - Edit home page > document overview > list view > gallery > image
	   - Edit the existing featured image > replace > upload
   - Block layout (E.g. About page)
      - Add new column block > highlight existing > more button > duplicate
	   - Customise block settings
- Customize the visual style of a page, such as colors, fonts, typography, and spacing.
   - Edit custom style.css file 
	- Identify the CSS selectors (E.g. .wp-site-blocks header)
	- Change the background color

Header Customization
- A main navigation menu can be placed in the header location suitable for intended audience. It can be customized under the theme's appearance in navigation section.
   - Click navigation menu > edit button
	- From block settings > rearrange or add new menu

Footer Customization
- Incorporated search function and social media integration.
   - Ability to change social media name to brand icon
      - Install and activate Social Media Share Buttons & Social Sharing Icons plugin
	   - From theme's appearance > templates > pages > edit icon
	   - Locate footer > Delete name > upload downloaded icons

### Continued Development
Login and Register Buttons
- Part of navigation menu in the header section -> to create 2 separate buttons for each form. It can be customized under the theme's appearance in templates section.
   - Navigate to pages > edit button
	- Add block for buttons > move block on top of the header 
	- Customize name > add the links of the login and register pages

Additional Site Pages
- Newsletter -> currently using Forminator plugin that enables Newsletter subscription but can use a better plugin to incorporate actual Newsletter pages
> [!NOTE]
> Ongoing testing with newsletter creation and verification if subscribers are receiveing the notification

- Forum for enhanced user engagement -> explore other suitable plugin as there are too many unnecessary details on the current extension

- Separate the `strategies` from About page and link to a `sponsorship` page or button

## Deployment Workflow

### Technologies Used
- CMS: `WordPress`
- Local Environment: `Varying Vagrant Vagrants`
- Production Environment: `Vagrant in AWS EC2 Instance`
- Project Management Board: `Trello`
- Version Control: `GitHub`
- Deployment Workflow: `GitHub Actions`
- Website Migration: `WPVivid Plugin`

### Project Management Board
`Trello` - collaboration tool that uses a system of boards, lists, and cards to help the team organize and manage tasks and projects.

Register to [Trello](https://trello.com/home) and join the team to get access to the board detailing the project/s.

### Local Environment
`Varying Vagrant Vagrants` is primarily chosen due to its preconfigured services such as Nginx, PHP, and MariaDB (or MySQL) that are commonly used in WordPress hosting environments. These services are set up to work optimally with WordPress.

### Website Migration Tool
`WpVivid` is a WordPress backup and migration plugin that simplifies and automates website backup, restoration, and migration tasks.
> [!Note]
> WPVivid Plugin must be installed and activated on both local and production WordPress site

### Version Control
Version control workflow is in `Github` which involves tracking and managing changes to the code and collaborating with others effectively. Currently using `master` branch to automate site changes from local to production environment.

## Getting Started

### Step I: Setup local environment
1. Install: [Vagrant](https://www.vagrantup.com/), [Git](https://git-scm.com/downloads), and [Virtual Box](https://www.virtualbox.org/wiki/Downloads)
2. Open a command prompt
3. `git clone -b stable https://github.com/Varying-Vagrant-Vagrants/VVV.git %systemdrive%%homepath%/vvv-local cd %systemdrive%%homepath%/vvv-local`
4. `vagrant plugin install --local`
5. `cd %systemdrive%%homepath%/vvv-local`
6. `vagrant up`
7. Launch IDE and open config/config.yml
8. Add new site using the markdown below:
   ```
      sites:
         u3a:
            skip_provisioning: false
            repo: https://github.com/Varying-Vagrant-Vagrants/custom-site-template.git
            hosts:
               - u3a.test
9. `vagrant up --provision`
10. Launch Dashboard from a web browser using this link: http://vvv.test/
11. Click the new website: http://u3a.test

### Step II: Website and database migration -> production to local environment
1. Install and activate WpVivid plugin in local 
2. Open WpVivid Back up found in the left panel
3. On the Source (Production) Website
   1. Click Backup & Restore tab 
	2. Click on the Backup Now button
	3. Download the generated backup file
4. On the Target (Local) Website
   1. Click Backup & Restore tab
	2. Click on the Upload tab
	3. Select the downloaded backup file
	4. Click Backups tab
	5. Click Restore icon
	6. Click Restore button and wait for process to complete

### Step III: Setup version control with local environment
1. Open a command prompt
2. `cd <path-to-themes-folder>`
3. `git clone https://github.com/VanessaCalimag/cp3402-adjunct-site.git`
4. `cd <path-to-theme-name-folder>`
5. `git branch` - will only display master branch as this the only branch currently setup
6. `git log --oneline` to explore repository's history
> [!Note]
> `git fetch` `git pull` if working directory log needs to be updated

### Step IV: Child theme development
1. Launch Visual Studio Code
2. Click File and open folder 
3. Locate the child theme folder from local directory
4. Modify required changes on the theme
5. Save changes
6. `git add .` or `git add (filename and extension)` to add a change in the working directory
7. `git commit -m "Description of changes"`
8. `git push` to add changes in GitHub repository
9. Changes should automatically flow directly from the repository to production site

### Automatic Workflow/Deployment
- GitHub Actions leveraged secret management for secure handling of sensitive information, 
   - SSH keys and server credentials within the project's repository [SECRET KEYS](https://github.com/VanessaCalimag/cp3402-adjunct-site/settings/secrets/actions).
      - `HOST_DNS`, `USERNAME`, `VAGRANT_SSH_KEY`
   - Customized workflow file to manage the deployment process
   ```
      name: Push-to-EC2

      on:
         push:
            branches:
               - master

      jobs:
         deploy:
            name: Deploy to EC2 on master branch push
            runs-on: ubuntu-latest

            steps:
               - name: Checkout the files
               uses: actions/checkout@v2

               - name: Set permissions for SSH private key
               run: |
                  echo "${{ secrets.VAGRANT_SSH_KEY }}" > vagrant.pem
                  chmod 600 vagrant.pem

               - name: Deploy to AWS instance
               env:
                  SSH_PRIVATE_KEY: ${{ secrets.VAGRANT_SSH_KEY }}
                  REMOTE_HOST: ${{ secrets.HOST_DNS }}
                  REMOTE_USER: ${{ secrets.USERNAME }}
               run: |
                  ssh -i vagrant.pem -o StrictHostKeyChecking=no $REMOTE_USER@$REMOTE_HOST "sudo curl -o /var/www/html/wp-content/themes/twentytwentytwo-child/style.css https://raw.githubusercontent.com/VanessaCalimag/cp3402-adjunct-site/master/twentytwentytwo-child/style.css"
                  ssh -i vagrant.pem -o StrictHostKeyChecking=no $REMOTE_USER@$REMOTE_HOST "sudo curl -o /var/www/html/wp-content/themes/twentytwentytwo-child/functions.php https://raw.githubusercontent.com/VanessaCalimag/cp3402-adjunct-site/master/twentytwentytwo-child/functions.php"
                  
### Production Environment
Vagrant possesses the capability to oversee various machine types beyond its default functionality. This is achieved by integrating additional providers with Vagrant such as AWS.

Set up:
1. Prerequisite Installations: Vagrant, Putty and PuttyGen SSH Client 
2. Create and setup an AWS Account
   Register for an [AWS Account](https://portal.aws.amazon.com/billing/signup#/start/email).
   - Setup an access key in AWS
     Add a new user [IAM Console](https://signin.aws.amazon.com/).
     - User must have Programmatic Access
     - Create and add a new group with AdministratorAccess.
       Access Key ID and the Secret Access Key will be provided.
3. Create a new Key Pair:
   Create SSH keys using PuTTYgen
   - Open PuTTYgen
   - Click the Generate Button
   - Move the mouse over the blank area of PuTTYgen
     When the key is generated it will display in text box for you
   - Click ‘Save Public Key’ to save public key
   - Click ‘Save Private Key’ to save private key
   - From the .ppk file, “Extract the private key using puttygen” by – using PuTTYgen to load the ppk
   - Go to Conversion -> Export OpenSSH key
   - Save file with extension for this file is .pem
4. In AWS:
   - In [EC2 console](https://eu-central-1.console.aws.amazon.com/ec2/v2/home?region=eu-central-1#Home:)
   - Under menu on the right : NETWORKING & SECURITY -> Key Pairs
   - Click Import Key 
   - Upload the public key created above
5. Setup a Security Group in AWS
   Allow an SSH connection to the new instance that gets created
   - In [EC2 console](https://eu-central-1.console.aws.amazon.com/ec2/v2/home?region=eu-central-1#Home:)
   - Under menu on the right : NETWORKING & SECURITY -> -> Security Groups
   - Create a new group, and add a Rule for SHH as in the image below
6. Choose an Image
   - Choose one in the region (closest to your location)
   - In EC2 console, click the Launch instance button
7. Prepare Vagrant:
   - Install the AWS provider plugin
     On your command prompt run the following commands:
     - `vagrant plugin install --plugin-version 1.0.1 fog-ovirt`
     - `vagrant plugin install vagrant-aws`
   - Add the dummy box using any name
     - Download the box from: https://github.com/mitchellh/vagrant-aws/blob/master/dummy.box to your computer
     - Run `vagrant box add aws/dummy dummy.box`
   - Setup environment variables for AWS_ACCESS_KEY & AWS_SECRET_KEY
   - Setup the Vagrantfile
   ```
      VAGRANTFILE_API_VERSION = "2"
      require 'vagrant-aws'

      Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
         config.vm.box = 'dummy'
         config.ssh.username = "ubuntu"
         config.vm.synced_folder ".", "/vagrant", disabled: true  

         config.vm.provider 'aws' do |aws, override|
            aws.access_key_id = 'AKIAYDKF2PCBZJQ5QTNR'
            aws.secret_access_key = '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'
            aws.keypair_name = 'vagrant'
            aws.region = "ap-southeast-2"
            aws.ami = "ami-0310483fb2b488153"
            aws.instance_type = "t2.micro"
            aws.security_groups = ['vagrant-group']

            override.ssh.username = 'ubuntu'
            override.ssh.private_key_path = '.ssh/vagrant.pem'
         end # config.vm.provider 'aws'
      end # Vagrant.configure
8. Launch the Instance in AWS
   - Launch the instance using `vagrant up` in command prompt
   - Login to the instance using `vagrant ssh`

