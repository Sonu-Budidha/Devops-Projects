# 🚀 Weekend Project: Serverless Web App + Microservices APIs

## 📖 Introduction
In this project, we build a **serverless microservices application** using AWS services.  
Instead of running servers manually, we let AWS handle the infrastructure.  

The app includes:
- **👤 Users Service** → Manage users  
- **🛍 Products Service** → Manage products  
- **📑 Orders Service** → Manage orders  
- **🌐 Frontend UI** → A simple dashboard and login page hosted on **Amazon S3**  

By the end, you will have:
✔ A login page to access the app  
✔ A dashboard to add & view users, products, and orders  
✔ A backend running fully on **AWS Lambda**  
✔ Data stored in **Amazon DynamoDB**  
✔ APIs managed by **Amazon API Gateway**  

---

## 🏛 Architecture Overview

**Flow of the app:**
1. User logs in through the frontend (HTML/JS hosted on S3).  
2. UI calls API Gateway endpoints (REST API).  
3. API Gateway triggers Lambda functions.  
4. Lambda functions perform logic and store/retrieve data in DynamoDB.  

---

## 🛠 AWS Services Used
- **Amazon S3** → Hosting static website (login + dashboard HTML).  
- **Amazon API Gateway** → Exposes REST endpoints (`/users`, `/products`, `/orders`).  
- **AWS Lambda** → Runs backend logic (functions for create & list).  
- **Amazon DynamoDB** → NoSQL database for storing users, products, and orders.  
- **IAM Roles/Policies** → Secure permissions for Lambda to access DynamoDB.  

---

## 🪜 Project Steps

### Step 1 – DynamoDB Setup
Create three tables:
- **Users** → `userId` (Primary Key)  
- **Products** → `productId` (Primary Key)  
- **Orders** → `orderId` (Primary Key)  

---

### Step 2 – Lambda Functions
Create **6 Lambda functions** (Python) and attach **IAM role with DynamoDB permissions**.  

- `users-post.py` → Add a user  
- `users-get.py` → List all users  
- `products-post.py` → Add a product  
- `products-get.py` → List all products  
- `orders-post.py` → Create an order  
- `orders-get.py` → List all orders  

📂 These scripts are already stored in the repo under file name "all-lambda-functions".

---

### Step 3 – API Gateway Setup
- Create a **REST API** in API Gateway.  
- Create resources:
  - `/users` → Methods: **POST**, **GET**  
  - `/products` → Methods: **POST**, **GET**  
  - `/orders` → Methods: **POST**, **GET**  
- Integrate each route with the corresponding Lambda function.  
- Enable **CORS** (important for frontend access).  
- Deploy API and note the **Invoke URL** (e.g., `https://xxxx.execute-api.us-east-1.amazonaws.com/Test`).  

---

### Step 4 – Frontend (UI)
Use the two HTML pages already in the repo :  

- `login.html` → Login page (stores username in browser local storage).  
- `dashboard.html` → Main dashboard (Users, Products, Orders).  

👉 Update the `API` variable in `dashboard.html` with your **API Gateway Invoke URL**.  

Finally, **upload the HTML files to your S3 bucket** and enable **Static Website Hosting**.  

---

## 🎯 End Result
✔ Students can log in from the `login.html` page.  
✔ Add and list **users, products, and orders** from the dashboard.  
✔ Data is stored securely in DynamoDB.  
✔ Fully serverless → **no servers to manage, pay only for what you use**.  

---

## 📂 Repository Structure

/frontend
├── login.html
├── dashboard.html

/lambdas
├── users-post.py
├── users-get.py
├── products-post.py
├── products-get.py
├── orders-post.py
├── orders-get.py

