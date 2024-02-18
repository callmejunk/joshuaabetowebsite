<?php
include "header.php";
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}
?>

<div class="container d-flex my-5 align-items-center justify-content-center" style="height: auto; font-size: .8rem">
        <div class="shadow p-4 rounded-5" style="width:300px; height: auto;">
        <?php 
        if(isset($_GET['editprof'])) { 
        $userID = $_GET['id']; 
        
        $getUser=$conn->prepare("SELECT * from users WHERE user_id = ?");
        $getUser->execute([$userID]);
        
        foreach($getUser as $user) { ?>

            <form method="post" action="backend.php">
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="hidden" class="form-control" id="exampleInputEmail1" name="uID" value="<?=$user['user_id']?>">
                    <input type="text" class="form-control" id="exampleInputEmail1" name="fName" value="<?=$user['First']?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputEmail2" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail2" name="lName" value="<?=$user['Last']?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputEmail3" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" name="email" value="<?=$user['Email']?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword4" name="p1">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword5" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword5" name="p2">
                </div>
                <div class="mb-2 form-check card-body text-center">
                    <button type="submit" class="btn btn-info text-white " name="editprof">Submit</button>
                </div>
            </form>
            <?php } ?>
            <?php } ?>
        </div>
</div>

</div>

</body>
</html>