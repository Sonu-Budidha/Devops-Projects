🚀 Project: Host Website on AWS EC2 with Custom Folder Structure
----------------------------------------------------------------------------------------

🎤 Introduction:
In this project, you'll set up a web server on AWS EC2 to host a website using Nginx. You’ll configure a VPC, public subnet, internet access, and deploy a website with a custom folder structure.

🌍 End Result:

EC2 instance hosting a website

Custom folder structure for website deployment

Option for static website hosting on S3

🏛 Step 1 – Create a VPC
----------------------------------------------------------------------------------------
Go to VPC → Create VPC.

Name: My-Project-VPC

CIDR Block: 10.0.0.0/16

Click Create VPC.

Result: An isolated network for your project.


🌐 Step 2 – Create Public Subnet
----------------------------------------------------------------------------------------
Go to VPC → Subnets → Create Subnet.

Name: Public-Subnet-1, CIDR: 10.0.1.0/24

Select My-Project-VPC and click Create Subnet.

Result: Subnet created for the web server.


🔗 Step 3 – Attach Internet Gateway (IGW)
----------------------------------------------------------------------------------------
Go to VPC → Internet Gateways → Create IGW.

Name it My-IGW and attach to My-Project-VPC.

Result: VPC is connected to the internet.

🛣 Step 4 – Create Route Table
----------------------------------------------------------------------------------------
Go to VPC → Route Tables → Create Route Table.

Add route 0.0.0.0/0 → Target = My-IGW.

Associate it with Public-Subnet-1.

Result: Internet access enabled for the subnet.

🔐 Step 5 – Create Security Group
----------------------------------------------------------------------------------------
Go to EC2 → Security Groups → Create Security Group.

Add rules for SSH (22) and HTTP (80).

Result: Firewall configured for secure SSH and public HTTP access.

🖥 Step 6 – Launch EC2 Instance
----------------------------------------------------------------------------------------
Go to EC2 → Launch Instance.

AMI: Ubuntu Server 22.04 LTS, Instance Type: t2.micro

VPC: My-Project-VPC, Subnet: Public-Subnet-1, Security Group: WebServer-SG

Click Launch Instance.

Result: EC2 instance created and ready to use.

🛠 Step 7 – Install Nginx
----------------------------------------------------------------------------------------
SSH into EC2:

sudo apt update && sudo apt install nginx -y

Check status:

systemctl status nginx

Result: Nginx installed and running.

🌐 Step 8 – Deploy Your Website
----------------------------------------------------------------------------------------

SSH into EC2 and navigate to /var/www/html/:

cd /var/www/html/  
sudo rm index.nginx-debian.html  


Restart Nginx:

sudo systemctl restart nginx

Result: Website live at http://<Public-IP>.



🛠 Optional: Host Website on S3 (Static)
----------------------------------------------------------------------------------------

Create an S3 bucket and enable Static Website Hosting.

Upload your website files and configure public access.

Access the website via the provided S3 URL.

Result: Static website hosted on S3.


✅ Summary:
----------------------------------------------------------------------------------------
Created VPC and public subnet

Configured internet access and firewall rules

Launched EC2 and installed Nginx

Deployed website with custom folder structure

Optional: Hosted on S3 for static content.
