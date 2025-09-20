🚀 Project 02: Connect Application to Cloud Database & Secure with Networking
-------------------------------------------------------------------------------------------

🎤 Introduction

In the last project, you launched a basic web server on AWS.
In this project, you’ll go deeper and connect a web application running on an EC2 instance to a managed cloud database (Amazon RDS).

Along the way, you’ll configure VPC, subnets, routing, and security groups to ensure the app talks to the DB securely.

By the end, you will have:

🌍 A cloud-hosted web app

🗄 A managed RDS database (MySQL)

🔒 Secure communication between the two (private DB, no open access from the internet)


🏛 Step 1 – Create a VPC for Isolation
-------------------------------------------------------------------------------------------
Go to VPC → Your VPCs → Create VPC

Name: App-DB-VPC

CIDR Block: 10.0.0.0/16

✅ Why? This is your private cloud network. Both the EC2 app and RDS DB will live here.


🌐 Step 2 – Create Subnets
-------------------------------------------------------------------------------------------

Public Subnet (for EC2 app server)

CIDR: 10.0.1.0/24

Private Subnet (for RDS DB)

CIDR: 10.0.2.0/24

✅ Why? Best practice: expose only your app server, keep your DB private.

🔗 Step 3 – Internet Gateway + Routing
-------------------------------------------------------------------------------------------

Create Internet Gateway → Name: App-IGW → Attach to App-DB-VPC.

Create Route Table (Public-RT):

Add route 0.0.0.0/0 → Target = App-IGW.

Associate with Public Subnet.

Private subnet keeps only local routing.

✅ Why? Only EC2 (in public subnet) can access the internet. RDS (in private subnet) stays private.

🔐 Step 4 – Security Groups (Firewalls)
-------------------------------------------------------------------------------------------

App-SG (for EC2)

Allow SSH (22) → Source = My IP

Allow HTTP (80) → Source = Anywhere

DB-SG (for RDS)

Allow MySQL (3306) → Source = App-SG

✅ Why? App server can talk to DB, but internet cannot directly hit DB.


🖥 Step 5 – Launch EC2 for the Application
-------------------------------------------------------------------------------------------
Go to EC2 → Launch Instance

AMI: Ubuntu 22.04

Instance Type: t2.micro (Free Tier)

Subnet: Public Subnet (10.0.1.0/24)

Enable: Auto-assign Public IP

SG: App-SG

✅ Why? This instance will run your PHP app.

🗄 Step 6 – Create RDS Database (MySQL)
-------------------------------------------------------------------------------------------

Go to RDS → Create Database → Standard Create

Engine: MySQL (Free Tier Eligible)

DB Instance: db.t3.micro

VPC: App-DB-VPC

Subnet Group: Private Subnet (10.0.2.0/24)

Public Access: No

Security Group: DB-SG

✅ Why? DB will only be reachable inside VPC, from EC2 app server.

🌍 Step 7 – Setup Application & Connect to RDS
-------------------------------------------------------------------------------------------
1. SSH into EC2
ssh -i project-key.pem ubuntu@<EC2-Public-IP>

2. Install Apache, PHP, MySQL client
sudo apt update && sudo apt install apache2 php php-mysql mysql-client -y

3. Replace default web page with your app
cd /var/www/html/
sudo rm index.html
sudo nano index.php


📌 Paste your PHP app code (from repo).

🗄 Step 8 – Setup Database Schema
-------------------------------------------------------------------------------------------

1. Connect from EC2 to RDS
mysql -h <RDS-ENDPOINT> -u admin -p

2. Create Database and Table
CREATE DATABASE guestbook;
USE guestbook;

CREATE TABLE entries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


🗂 Step 9 – Verify
-------------------------------------------------------------------------------------------
From Web App:

Open browser → http://<EC2-Public-IP> → submit a message.

From MySQL:
SHOW DATABASES;
USE guestbook;
SHOW TABLES;

SELECT * FROM entries ORDER BY created_at DESC;

✅ You should see the same data in your DB and web app.

🎯 End Result
-------------------------------------------------------------------------------------------
A secure web app → hosted on EC2.

A private DB → hosted on RDS.

Messages stored via app and visible in DB queries.
