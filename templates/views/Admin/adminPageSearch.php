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
                </tr>
            </thead>
            <tbody id="goalsList">
                <?php if (!empty($searchUsers)) : ?>
                    <?php foreach ($searchUsers as $index => $user) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo  htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['type'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <!-- <td>
                                <a href="Edituser/<?php echo $user['id']; ?>" class="edit">Edit</a>&nbsp;&nbsp;
                                <div class="deleteButton">
                                    <form action="deleteuser" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this goal?')">Delete</button>
                                    </form>
                                </div>
                            </td> -->
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

<style>
.topContainer {
    display: flex;
    justify-content: end;
    margin-top: 100px;
}


.addButton {
    display: flex;
    justify-content: center;
    border-radius: 50%;
    cursor: pointer;
    background-color: black;
    height: 50px;
    width: 50px;
    border: none;
    margin-right: 186px;
}

.addButton a  {
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    margin-top: 5px;
    font-size: 28px;
}


.table-wrapper {
    margin-top: 60px;
    max-width: fit-content;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
}

.fl-table {
    margin-top: -30px;
    border-radius: 5px;
    font-size: 19px;
    border: none;
    border-collapse: collapse;
    width: 1257px;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
    height: 150px;
}

.fl-table .edit:hover {
    color: green;
}

.fl-table .delete:hover {
    color: red;
}

.fl-table td,
.fl-table th {
    text-align: center;
    /* padding: 8px; */
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 17px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}


@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }

    .table-wrapper:before {
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }

    .fl-table thead,
    .fl-table tbody,
    .fl-table thead th {
        display: block;
    }

    .fl-table thead th:last-child {
        border-bottom: none;
    }

    .fl-table thead {
        float: left;
    }

    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }

    .fl-table td,
    .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }

    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }

    .fl-table tbody tr {
        display: table-cell;
    }

    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }

    .fl-table tr:nth-child(even) {
        background: transparent;
    }

    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }

    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }

    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

.deleteButton form button {
    background-color: red;
    border: none;
    color: white;
    border-radius: 5px;
    padding: 3px 8px;
    cursor: pointer;
}

/* Search */
.searchGoal {
    max-width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.searchButton {
    margin-left: -40px;
    position: relative;
    width: 40px;
    height: 32px;
    border: 1px solid #00B4CC;
    background: #00B4CC;
    text-align: center;
    color: black;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
  }

  .searchTerm {
    width: 480px;
    border: 3px solid #00B4CC;
    border-right: none;
    height: 39px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #9DBFAF;
  }
  
  .searchTerm:focus{
    color: black;
  }
</style>
</style>