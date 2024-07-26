<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

if (!isLoggedIn()) {
    header('location: login');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="assets/userDashboard.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class=''></i>
            <span class="logo_name">FA</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard" class="active" id="dashboard">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="budget" id="budgets">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Budget</span>
                </a>
            </li>
            <li>
                <a href="goal">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Goals</span>
                </a>
            </li>
            <li>
                <a href="income">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Incomes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Stock</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-book-alt'></i>
                    <span class="links_name">Total order</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Team</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Messages</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Favrorites</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
            </li>
            <li class="log_out">
                <a href="logout">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="displayName">
                 <h2 id="name"></h2>

            </div>
            <div class="profile-details">
                <img src="images/profile.jpg" alt="">
                <span class="admin_name"><?php echo $_SESSION['user_email']; ?></span>
                <i class='bx bx-chevron-down'></i>
            </div>
        </nav>
    </div>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }


        var urlName = window.location.pathname.split('/').filter(segment => segment !== "");
        var lastName = urlName[urlName.length - 1];
        var resultName = lastName.toUpperCase();
        document.getElementById('name').innerHTML = resultName;
    </script>

</body>

</html>