<?php
include('header.php');

if(isset($_SESSION['logged_in'])){
    header("Location: home.php");
}

    // Login
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $seeCheck = $conn->prepare("SELECT * FROM users WHERE Email = ?");
        $seeCheck->execute([$email]);

        foreach($seeCheck as $check) {
            if($check['Email'] == $email && password_verify($pass, $check['Pass'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['u_id'] = $check['user_id'];

                header("Location: index.php");
            }
            else {
                $msg = "Password Incorrect!";
                header("Location: login.php?msg=$msg");
            }
        }
    }
?>

       <div class="container d-flex align-items-center justify-content-center" style="height: 75%; font-size: .8rem">
                <div class="shadow p-4 rounded-5" style="width:300px; height: 300px;">
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="mb-1">
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                            </div>
                        </div>
                        <div class="mb-3">  
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" name="password">
                        </div>
                        <div class="mb-3 form-check card-body text-end">
                            <a class="text-info" href="register.php" class="mx-3">Sign Up?</a>
                        </div>
                        <div class="mb-3 form-check card-body text-center">
                            <button type="submit" class="btn btn-outline-info text-info" name="login">Submit</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    
</body>
</html>

    
