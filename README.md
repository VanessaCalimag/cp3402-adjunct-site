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
- A personalized logo that can be incorporated into the header. It can be configured and tailored via the site identity settings.

Page Customization
- Ability to modify the layout, structure, and visual elements of a page.
- Customize the visual style of a page, such as colors, fonts, typography, and spacing.
- Add, remove, or reorganize content on a page.

Header Customization
- A main navigation menu can be placed in the header location suitable for intended audience.

Footer Customization
- Incorporated search function and social media integration

### Continued Development
Additional Site Pages
- Newsletter -> used a plugin that enables Newsletter subscription but can use a better plugin to incorporate actual Newsletter pages

- Forum for enhanced user engagement -> explore other suitable plugin as there are too many unnecessary details on the current extension

- Separate the `strategies` of the website from About page and link to a `sponsorship` page or button

## Deployment Workflow

### Technologies Used
- CMS: `WordPress`
- Local Environment: `Varying Vagrant Vagrants`
- Production Environment: `Vagrant in AWS EC2 Instance`
- Project Management Board: `Trello`
- Version Control: `GitHub`
- Deployment Workflow: `GitHub Actions`
- Website Migration: `WPVivid Plugin`

### General Workflow
1. Local Development Environment Setup (Windows Only)
- Varying Vagrant Vagrants is primarily chosen due to its preconfigured services such as Nginx, PHP, and MariaDB (or MySQL) that are commonly used in WordPress hosting environments. These services are set up to work optimally with WordPress.
   - Prerequisite Installations: Vagrant, Git, Virtual Box 
   - Grab a copy of VVV using git
      - Open a command prompt, and enter the following command:
      - `git clone -b stable https://github.com/Varying-Vagrant-Vagrants/VVV.git %systemdrive%%homepath%/vvv-local cd %systemdrive%%homepath%/vvv-local`
      - `vagrant plugin install --local`
      - Start VVV by opening a terminal
      - Change to the VVV folder `cd %systemdrive%%homepath%/vvv-local`
      - Run `vagrant up`
   - Add a new site in `config/config.yml` and run `vagrant up --provision` to reprovision
   ```
      sites:
         u3a:
            skip_provisioning: false
            repo: https://github.com/Varying-Vagrant-Vagrants/custom-site-template.git
            hosts:
               - u3a.test

- Run `vagrant up --provision`
- Launch [Dashboard](http://vvv.test) from a web broser
- Websites will be in the `www` folder

Visit the official website in [Varying Vagrant Vagrants](https://varyingvagrantvagrants.org/) for detailed instructions of VVV installation for MAC users.

2. Website Migration using WPVivid Plugin
- Note: WPVivid Plugin must be installed and activated on both local and production WordPress site
   - On the Source (Production) Website:
      - From the `Backup & Restore` tab click on the `Backup Now` button 
      - Download the generated backup file
   - On the Target (Local) Website:
      - From the `Backup & Restore` tab, click on the `Upload` tab
      - Select the downloaded backup file
      - Click `Backups` tab
      - Click `Restore` icon
      - Click `Restore` button and wait for process to complete

3. Version Control
- Version control workflow in Github involves tracking and managing changes to the code and collaborating with others effectively.
   - Initialize a version control system (e.g., Git) within your VVV project directory if it's not already initialized. 
      - Run the following commands to clone the repository `git clone https://github.com/VanessaCalimag/cp3402-adjunct-site.git`
   - To commit your changes using Git:
      - `git add .`
      - `git commit -m "Description of changes"`

### Automatic Workflow
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

### Project Management Board
Trello - collaboration tool that uses a system of boards, lists, and cards to help the team organize and manage tasks and projects.

Register to [Trello](https://trello.com/home) and join the team to get access to the board detailing the project/s.