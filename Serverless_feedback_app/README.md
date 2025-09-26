🚀 Project 03: Serverless Guestbook with AWS Lambda, API Gateway & DynamoDB
-----------------------------------------------------------------------------
🎤 Introduction

In the last project, you connected an EC2 web app to a managed RDS database.
In this project, you’ll build a fully serverless web application using:

AWS Lambda → backend logic (no servers to manage).
Amazon API Gateway → API endpoints (POST/GET).
Amazon DynamoDB → NoSQL database to store messages.
Static Website (HTML/JS) → simple guestbook UI hosted on S3 or EC2.

By the end, you will have:

🌍 A web guestbook where users can submit and view messages.
⚡ A backend running fully on Lambda (pay-per-use, serverless).
🗄 Data stored securely in DynamoDB.
🔗 API Gateway connecting frontend ↔ backend.

🏛 Step 1 – Create DynamoDB Table
-----------------------------------------------------------------------------

Go to DynamoDB → Tables → Create Table

Table Name: Bucketname

Partition Key: id (String)

✅ Why? This is where all guestbook messages will be stored.

🔗 Step 2 – Create Lambda Functions
-----------------------------------------------------------------------------

You need two Lambda functions:

📩 Function 1: lamda-post (POST messages)
📜 Function 2: lambda-get (GET messages)

These both files are present in this Repo

✅ Why? One Lambda saves messages, the other retrieves them.


🔑 Step 3 – Permissions
-----------------------------------------------------------------------------

Both Lambda functions need permission to access DynamoDB.

Attach the policy AmazonDynamoDBFullAccess (or a custom one with just PutItem + Scan).

🌐 Step 4 – Setup API Gateway
-----------------------------------------------------------------------------

Go to API Gateway → Create API → HTTP API.

Create two routes:

POST /messages → Integrates with lamda-post Lambda.

GET /messages → Integrates with lambda-get  Lambda.

Enable CORS (so frontend can call API).

Deploy API → note down API endpoint (e.g., https://xxxxx.execute-api.us-east-1.amazonaws.com/New/messages).

✅ Why? API Gateway exposes your Lambda as REST endpoints.

🖥 Step 5 – Create Frontend (index.html)
-----------------------------------------------------------------------------

The index.html is present in this Repo

🗂 Step 6 – Host the Frontend
-----------------------------------------------------------------------------
You can host index.html on:

S3 (Static Website Hosting)

EC2 (Apache/Nginx)

Or even CloudFront + S3 for global delivery.

Open the site in browser → try submitting a message → check DynamoDB table.

🎯 End Result

✔ Users submit messages → API Gateway → Lambda → DynamoDB.
✔ Messages can be retrieved and displayed on the website.
✔ Fully serverless architecture → no servers to manage.
