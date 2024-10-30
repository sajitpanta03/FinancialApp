<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php include "adminPage.php"; ?>

    <div class="dashboard">
        <h1>Dashboard</h1>

        <div class="card">
            <h2>Total Users</h2>
            <p><?php echo $totalUsers; ?></p>
        </div>
    </div>
</body>
</html>

<style>
    .dashboard {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 50px;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 200px;
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #333;
    }

    .card p {
        margin: 10px 0 0;
        font-size: 2rem;
        color: #28a745;
    }
</style>
