<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>About Us | Khatapana</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            background: #121212; /* Dark background for the whole page */
            color: #e0e0e0; /* Light text color */
        }

        .about-us {
            display: flex;
            align-items: center;
            height: 100vh;
            width: 100%;
            padding: 90px 0;
        }

        .pic {
            height: auto;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        .about {
            width: 1130px;
            max-width: 85%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .text {
            width: 540px;
        }

        .text h2 {
            color: #f0f0f0;
            font-size: 70px; /* Slightly smaller for a cleaner look */
            font-weight: 600;
            margin-bottom: 10px;
        }

        .text h5 {
            color: #b0bec5;
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .text span {
            color: #4070f4; /* Accent color */
        }

        .text p {
            color: #e0e0e0;
            font-size: 18px;
            line-height: 25px;
            letter-spacing: 1px;
        }

        .data {
            margin-top: 30px;
        }

        .hire {
            font-size: 18px;
            background: #4070f4;
            color: #fff;
            text-decoration: none;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            transition: 0.5s;
        }

        .hire:hover {
            background: #0056b3; /* Darker shade on hover */
        }

        .features {
            padding: 60px 0;
            background: #121212;
        }

        .features h3 {
            color: #f0f0f0;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .features ul {
            list-style: none;
            padding: 0;
        }

        .features li {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .features li span {
            color: #4070f4; 
        }
    </style>
</head>

<body>
    <section class="about-us">
        <div class="about">
            <img src="assets/photos/bg-form-goal.jpg" class="pic" alt="About Us Image" />
            <div class="text">
                <h2>About Us</h2>
                <h5>Front-end Developer & <span>Designer</span></h5>
                <p>Welcome to FinancialApp, your go-to app for comprehensive financial management. We are dedicated to providing an intuitive platform that helps you track your income, manage budgets, and analyze spending patterns effectively.</p>
                <p>Our application offers features designed to simplify your financial planning:</p>
                <div class="features">
                    <h3>Key Features of FinancialApp:</h3>
                    <ul>
                        <li><strong>Record Budget and Expenses:</strong> Set up and adjust budgets, and track daily expenses with ease. Attach receipts for better tracking.</li>
                        <li><strong>Income Tracking:</strong> Log various sources of income and link them to financial goals or budgets.</li>
                        <li><strong>Detailed Reports:</strong> Generate reports to visualize income vs. expenses and categorize spending patterns.</li>
                        <li><strong>Trend Analysis:</strong> Analyze historical data to forecast future financial behavior and adjust budgets accordingly.</li>
                        <li><strong>Financial Goals and Savings:</strong> Set and track progress toward specific financial goals, and manage savings effectively.</li>
                    </ul>
                </div>
                <div class="data">
                    <a href="/FinancialApp/login" class="hire">Get Started</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
