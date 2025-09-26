# 🚀 Serverless Guestbook with AWS Lambda, API Gateway & DynamoDB

## 📖 Introduction
In this project, you'll build a **fully serverless web application** for a **guestbook** using AWS services.  
No need to manage any servers – AWS handles the infrastructure for you!

The app includes:
- **💌 Message Service** → Submit and retrieve guestbook messages  
- **🌐 Frontend UI** → A simple guestbook page hosted on **Amazon S3** or **EC2**  

By the end, you'll have:
✔ A guestbook webpage where users can submit and view messages  
✔ A backend running fully on **AWS Lambda**  
✔ Data stored securely in **Amazon DynamoDB**  
✔ APIs managed by **Amazon API Gateway**  

---

## 🏛 Architecture Overview

**How the app works:**
1. **Frontend (HTML/JS)** hosted on **S3** or **EC2** provides the interface.  
2. User interacts with the frontend to submit or view messages.  
3. The frontend communicates with **API Gateway** via REST API requests (POST/GET).  
4. **API Gateway** triggers corresponding **Lambda functions**.  
5. **Lambda** handles the logic (storing/retrieving data from **DynamoDB**).

---

## 🛠 AWS Services Used
- **Amazon S3/EC2** → Hosting the static guestbook page  
- **Amazon API Gateway** → Exposing REST endpoints for `/messages`  
- **AWS Lambda** → Running serverless backend logic  
- **Amazon DynamoDB** → Storing guestbook messages in a NoSQL database  
- **IAM Roles/Policies** → Securing permissions for Lambda to access DynamoDB  

---

## 🪜 Project Steps

### Step 1 – DynamoDB Setup
Create a **DynamoDB table** to store guestbook messages:
- **Table Name** → `Bucketname`  
- **Partition Key** → `id` (String)

> ✅ **Why?** This table will store all guestbook messages.

---

### Step 2 – Lambda Functions
Create **2 Lambda functions** (in Python) and attach **IAM roles with DynamoDB permissions**:

- `lambda-post.py` → Handle **POST** requests (store a new message)
- `lambda-get.py` → Handle **GET** requests (retrieve all messages)

📂 These files are already available in the `/lambdas/` folder.

> ✅ **Why?** One Lambda adds messages to DynamoDB, the other retrieves them.

---

### Step 3 – Permissions
Ensure that the Lambda functions have the correct permissions to interact with DynamoDB.

- Attach the **AmazonDynamoDBFullAccess** policy (or create a custom one with just `PutItem` and `Scan` permissions).

---

### Step 4 – API Gateway Setup
- Go to **API Gateway** → **Create API** → **HTTP API**.
- Create **two routes**:
  - `POST /messages` → Connect to `lambda-post` Lambda  
  - `GET /messages` → Connect to `lambda-get` Lambda  
- Enable **CORS** for frontend access.  
- Deploy the API and note the **API endpoint** (e.g., `https://xxxx.execute-api.us-east-1.amazonaws.com/New/messages`).

> ✅ **Why?** API Gateway exposes your Lambda functions as RESTful endpoints for your frontend to call.

---

### Step 5 – Frontend (index.html)
The **index.html** is already included in the repo. This page provides the simple UI for submitting and viewing messages.

---

### Step 6 – Host the Frontend
You can host the **index.html** page on any of these services:
- **Amazon S3** (Static Website Hosting)  
- **Amazon EC2** (Apache/Nginx)  
- **CloudFront + S3** (for global delivery)

> After uploading the HTML, open the site in a browser and try submitting a message. Check the **DynamoDB table** to see if it's stored!

---

## 🎯 End Result
✔ **Users submit messages** → API Gateway → Lambda → DynamoDB  
✔ **Retrieve and display messages** on the website  
✔ Fully **serverless architecture** → No servers to manage, pay only for what you use  

---

## 📂 Repository Structure

/frontend
├── index.html

/lambdas
├── lambda-post.py
├── lambda-get.py
