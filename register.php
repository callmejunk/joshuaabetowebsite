<?php
include "header.php";

?>

<div class="container d-flex my-5 align-items-center justify-content-center" style="height: auto; font-size: .8rem">
        <div class="shadow p-4 rounded-5" style="width:300px; height: auto;">
            <form method="post" action="backend.php">
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="fName">
                </div>
                <div class="mb-2">
                    <label for="exampleInputEmail2" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail2" name="lName">
                </div>
                <div class="mb-2">
                    <label for="exampleInputEmail3" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" name="email">
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
                    <button type="submit" class="btn btn-info" name="register">Submit</button>
                </div>
            </form>
        </div>
</div>

</div>

</body>
</html>