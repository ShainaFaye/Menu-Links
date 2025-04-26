<?php
$conn = new mysqli("localhost", "root", "", "dbContacts");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables
$studno = $name = $cpno = "";

// Search handler
if (isset($_POST['search'])) {
    $studno = $_POST['studno'];
    $res = $conn->query("SELECT * FROM tblSMS WHERE studno = '$studno'");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $name = $row['name'];
        $cpno = $row['cpno'];
    } else {
        echo "<script>alert('Student not found');</script>";
    }
}

// Add handler
if (isset($_POST['add'])) {
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];
    $conn->query("INSERT INTO tblSMS (studno, name, cpno) VALUES ('$studno', '$name', '$cpno')");
    echo "<script>alert('Record added successfully!');</script>";
}

// Update handler
if (isset($_POST['update'])) {
    $studno = $_POST['studno_hidden'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];
    $conn->query("UPDATE tblSMS SET name='$name', cpno='$cpno' WHERE studno='$studno'");
    echo "<script>alert('Record updated successfully!');</script>";
}


// Delete handler
if (isset($_POST['delete'])) {
    $studno = $_POST['studno'];
    $conn->query("DELETE FROM tblSMS WHERE studno='$studno'");
    echo "<script>alert('Record deleted successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SMS Manager</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f5f5f5;
            margin: 20px;
        }
        h3 {
            margin-top: 40px;
            color: #333;
            color: blue;
            font-family: 'Cooper Black', sans-serif;
        }
        nav {
            text-align: center;
            margin-bottom: 30px;
        }

        nav a {
            background-color:rgb(170, 211, 255);
            color: white;
            padding: 6px 14px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid black;
            font-family: 'Cooper Black', sans-serif;
            color: black;
        }
        .menu-links {
    background-color: rgb(250, 199, 250);
    color: black;
    padding: 10px 15px;
    margin: 5px auto 30px auto;
    text-align: center;
    border-radius: 5px;
    border: 1px solid black;
    font-family: 'Cooper Black', sans-serif;
    width: fit-content;
}


        form {
            max-width: 500px;
            margin: 0 auto 30px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: inline-block;
            width: 130px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            width: calc(100% - 140px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .search-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .search-group label {
            margin-right: 10px;
            white-space: nowrap;
            width: 130px;
            font-weight: bold;
        }

        .search-group input[type="text"] {
            width: 225px;
            padding: 8px;
            box-sizing: border-box;
        }

        .search-group input[type="submit"] {
            margin-left: 10px;
            background-color: #ffc107;
            color: black;
            padding: 5px 14px;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Cooper Black', sans-serif;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: 1px solid black;
            padding: 8px 13px;
            border-radius: 5px;
            cursor: pointer;
            color: black;
            font-family: 'Cooper Black', sans-serif;
        }

        input[type="submit"]:hover {
            opacity: 0.9;
            

        }
        .input-inline-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

.input-inline-group label {
    width: 130px;
    font-weight: bold;
    margin-right: 10px;
    white-space: nowrap;
}

.input-inline-group input[type="text"] {
    width: calc(100% - 256px);
    padding: 8px;
    margin-right: 10px;
    box-sizing: border-box;
}

.input-inline-group small {
    white-space: nowrap;
    font-size: 0.85em;
    color: #555;
}

.button-group {
    display: flex;
    align-items: center;
    margin-top: 10px;
    margin-left: 130px; /* aligns with input start */
}

    </style>
</head>
<body>

<div class="menu-links">
    Menu Links:
</div>

<nav>
    <a href="#add">Add Record</a> |
    <a href="#update">Update Record</a> |
    <a href="#delete">Delete Record</a>
</nav>




<!-- ADD -->
<a name="add"></a>
<div style="text-align: center;">
<h3>Add Record</h3>
<form method="post">
    <label>Student Number:</label>
    <input type="text" name="studno" required><br>

    <label>Name:</label>
    <input type="text" name="name" required><br>

    <div class="input-inline-group">
    <label for="cpno-add">CP No.:</label>
    <input type="text" name="cpno" id="cpno-add" value="63" required>
    <small> <i><b>(ex. 639201234567) </i> </b> </small>
</div>

<div class="button-group">
    <input type="submit" name="add" value="Save">
</div>

</form>

<!-- UPDATE -->
<a name="update"></a>
<h3>Update Record</h3>
<form method="post">
    <div class="search-group">
        <label for="studno">Student Number:</label>
        <input type="text" name="studno" id="studno" value="<?php echo $studno; ?>" required>
        <input type="submit" name="search" value="Search">
    </div>

    <input type="hidden" name="studno_hidden" value="<?php echo $studno; ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>

    <div class="input-inline-group">
    <label for="cpno">CP No.:</label>
    <input type="text" name="cpno" id="cpno" value="<?php echo $cpno ?: '63'; ?>">
    <small> <i><b>(ex. 639201234567)</b></i> </small>
    </div>

    <div class="button-group">
        <input type="submit" name="update" value="Update">
    </div>
</form>


<!-- DELETE -->
<a name="delete"></a>
<h3>Delete Record</h3>
<form method="post">
    <div class="search-group">
        <label for="studno-delete">Student Number:</label>
        <input type="text" name="studno" id="studno-delete" value="<?php echo $studno; ?>" required>
        <input type="submit" name="search" value="Search">
    </div>

    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" readonly><br>

    <div class="input-inline-group">
    <label for="cpno-del">CP No.:</label>
    <input type="text" name="cpno" id="cpno-del" value="<?php echo $cpno; ?>" readonly>
    <small> <i><b>(ex. 639201234567) </i> </b> </small>
</div>

<div class="button-group">
    <input type="submit" name="delete" value="Delete">
</div>

</form>

</body>
</html>
