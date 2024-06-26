<?php
include("connection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if (($password === $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role_id'];

            if ($row['role_id'] == 2) {
                $customerSql = "SELECT customer_id FROM customers WHERE user_id = " . $row['user_id'];
                $customerResult = mysqli_query($conn, $customerSql);
                $customerRow = mysqli_fetch_assoc($customerResult);
                $_SESSION['customer_id'] = $customerRow['customer_id'];
            }

            switch ($row['role_id']) {
                case 2:
                    header("Location: dashboard_clients.php");
                    break;
                case 1:
                    header("Location: dashboard_admin.php");
                    break;
                default:
                    header("Location: welcom.php");
            }

            exit();
        } else {
            echo '<script>
                alert("Invalid Username or Password");
                window.location.href = "index.php";
            </script>';
        }
    } else {
        echo "Error: " . mysqli_error($conn); 
    }
}
?>


<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <script>
        function isvalid() {
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if (user == "" && pass == "") {
                alert("please enter username and pawword");
                return false;
            }
            if (user == "") {
                alert("please enter username");
                return false;
            } else if (pass == "") {
                alert("please enter password");
                return false;
            } else {
                return true;
            }
        }
    </script>
</head>

<body>
    <div id="form">
        <div class="d_flex">
        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 100 100" width="100px" height="100px"><path fill="#f1bc19" d="M77 12A1 1 0 1 0 77 14A1 1 0 1 0 77 12Z"/><path fill="#e4e4f9" d="M50 13A37 37 0 1 0 50 87A37 37 0 1 0 50 13Z"/><path fill="#f1bc19" d="M83 11A4 4 0 1 0 83 19A4 4 0 1 0 83 11Z"/><path fill="#8889b9" d="M87 22A2 2 0 1 0 87 26A2 2 0 1 0 87 22Z"/><path fill="#fbcd59" d="M81 74A2 2 0 1 0 81 78 2 2 0 1 0 81 74zM15 59A4 4 0 1 0 15 67 4 4 0 1 0 15 59z"/><path fill="#8889b9" d="M25 85A2 2 0 1 0 25 89A2 2 0 1 0 25 85Z"/><path fill="#fff" d="M18.5 49A2.5 2.5 0 1 0 18.5 54 2.5 2.5 0 1 0 18.5 49zM79.5 32A1.5 1.5 0 1 0 79.5 35 1.5 1.5 0 1 0 79.5 32z"/><g><path fill="#fffef4" d="M50 25.625A24.25 24.25 0 1 0 50 74.125A24.25 24.25 0 1 0 50 25.625Z"/><path fill="#472b29" d="M50,74.825c-13.758,0-24.95-11.192-24.95-24.95S36.242,24.925,50,24.925s24.95,11.192,24.95,24.95 S63.758,74.825,50,74.825z M50,26.325c-12.985,0-23.55,10.564-23.55,23.55S37.015,73.425,50,73.425s23.55-10.564,23.55-23.55 S62.985,26.325,50,26.325z"/></g><g><path fill="#ee3e54" d="M50 30A19.875 19.875 0 1 0 50 69.75A19.875 19.875 0 1 0 50 30Z"/></g><g><path fill="#472b29" d="M69.424,44.625c-0.214,0-0.412-0.138-0.478-0.353c-0.089-0.288-0.184-0.572-0.284-0.854 c-0.39-1.089-0.885-2.155-1.47-3.169c-0.139-0.239-0.057-0.545,0.183-0.683c0.239-0.14,0.543-0.058,0.683,0.183 c0.616,1.065,1.136,2.187,1.546,3.331c0.106,0.297,0.205,0.595,0.298,0.896c0.082,0.265-0.066,0.544-0.33,0.625 C69.522,44.618,69.473,44.625,69.424,44.625z"/></g><g opacity=".79"><path fill="#f7667e" d="M49.87,32.691c9.155,0,16.93,5.97,19.87,14.309c-1.639-9.731-9.901-17.14-19.87-17.14 S31.639,37.269,30,47C32.941,38.663,40.715,32.691,49.87,32.691z"/></g><g><path fill="#472b29" d="M50,70.75c-11.511,0-20.875-9.337-20.875-20.813S38.489,29.125,50,29.125 c5.975,0,11.674,2.56,15.636,7.023c0.3,0.337,0.588,0.685,0.865,1.041c0.17,0.218,0.131,0.531-0.088,0.701 c-0.217,0.169-0.531,0.13-0.701-0.088c-0.264-0.339-0.538-0.669-0.823-0.99c-3.773-4.25-9.199-6.688-14.889-6.688 c-10.959,0-19.875,8.888-19.875,19.813S39.041,69.75,50,69.75s19.875-8.888,19.875-19.813c0-0.992-0.074-1.992-0.222-2.973 c-0.041-0.273,0.146-0.527,0.42-0.568c0.271-0.039,0.527,0.146,0.568,0.42c0.155,1.029,0.233,2.079,0.233,3.121 C70.875,61.413,61.511,70.75,50,70.75z"/></g><g><path fill="#f1bc19" d="M49.217 37.218L56.954 52.565 51.572 52.565 51.572 62.782 42.826 48.149 49.217 48.149z"/><path fill="#472b29" d="M51.571,63.282c-0.173,0-0.337-0.09-0.429-0.243l-8.745-14.633 c-0.093-0.155-0.095-0.347-0.006-0.504c0.089-0.156,0.255-0.253,0.435-0.253h5.892V37.218c0-0.231,0.159-0.433,0.385-0.486 c0.224-0.058,0.458,0.054,0.562,0.262L57.4,52.34c0.078,0.154,0.07,0.339-0.021,0.486c-0.091,0.148-0.252,0.238-0.426,0.238h-4.883 v9.718c0,0.225-0.15,0.422-0.367,0.482C51.66,63.276,51.615,63.282,51.571,63.282z M43.707,48.649l7.364,12.321v-8.406 c0-0.276,0.224-0.5,0.5-0.5h4.571L49.718,39.32v8.829c0,0.276-0.224,0.5-0.5,0.5H43.707z"/></g></svg>
        </div>
        
        <form action="index.php" name="form" method="post" onsubmit="return isvalid()">
            <label for="">Username: </label>
            <input type="text" id="user" name="user"> <br> <br>
            <label for="">Password: </label>
            <input type="password" id="pass" name="pass"> <br> <br>
            <input type="submit" id="btn" value="login" name="submit">
        </form>

    </div>

</body>

</html>