<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/innerStyle.css">
    <title>users</title>
</head>

<body>
    <?php include "adminPage.php"; ?>
    <div class="topContainer">
        <!-- <div class="addButton">
            <a href="adduser" class="button">+</a>
        </div> -->
    </div>

    <div class="searchGoal">
        <form action="/FinancialApp/searchUsers" method="POST">
            <input type="text" id="search" name="search" class="searchTerm" placeholder="Search user...">
            <button type="submit" class="searchButton">
                <svg fill="#000000" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488.4 488.4" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6 s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2 S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7 S381.9,104.65,381.9,203.25z"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            </button>
        </form>
    </div>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Register date</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="goalsList">
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $index => $user) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo  htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['type'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <!-- <a href="Edituser/<?php echo $user['id']; ?>" class="edit">Edit</a>&nbsp;&nbsp; -->
                                <div class="deleteButton">
                                    <form action="/FinancialApp/deleteUser" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this goal?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>