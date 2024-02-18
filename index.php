<?php
include 'header.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    ob_end_flush();
}
?>

<div class="container-fluid d-flex justify-content-center">
    <div class="search_main">
        <div class="student_search">
            <form action="" method="POST">
                <input type="hidden" name="userID" value="<?= $_SESSION['u_id'] ?>">
                <input class="rounded-3 px-3 py-1 " type="text" name="records" value="" placeholder="Search Record">
                <input class="rounded-3 px-2 py-1 text-info btn-outline-info" type="submit" name="search" value="🔎">
            </form>
            <?php
            if (isset($_POST['search'])) {
            ?>
                <div class="container d-flex justify-content-center ">
                    <table class="table mt-2 table-bordered ">
                        <thead class="alert-info">
                        </thead>
                        <tbody>
                            <?php
                            $userID = $_POST['userID'];
                            $record = $_POST['records'];
                            $getSearch = $conn->prepare("SELECT * FROM `records` WHERE `user_id` LIKE '%$userID%' AND `FirstName` LIKE '%$record%'");
                            $getSearch->execute();
                            foreach ($getSearch as $search) {
                            ?>
                                <tr>
                                    <td><?= $search['FirstName'] ?></td>
                                    <td><?= $search['LastName'] ?></td>
                                    <td><?= $search['Course'] ?></td>
                                    <td><?= $search['Section'] ?></td>
                                </tr>


                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="tab-content d-flex my-5 justify-content-center align-items-center" id="v-pills-tabContent" style="height: 300px;">

    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
        <div class="px-2 position-relative" style="font-size: .8rem;">

            <table class="table">
                <thead align="center">
                    <tr>
                        <th scope="col" class="text-start px-md-4">First</th>
                        <th scope="col" class="px-md-4">Last</th>
                        <th scope="col" class="px-md-4">Course</th>
                        <th scope="col" class="px-md-4">Section</th>
                        <th scope="col" class="px-md-4">Action</th>
                    </tr>
                </thead>
                <tbody align="center">

                        <?php
                        $userID = $_SESSION['u_id'];
                        $selectID = $conn->prepare("SELECT COUNT(*) FROM records WHERE user_id=?");
                        $selectID->execute([$userID]);

                        $tItems = $selectID->fetchColumn();

                        $page = 5;
                        $cnt = 1;

                        $cPage = isset($_GET['page']) ? max(1, $_GET['page']) : 1;

                        $offset = ($cPage - 1) * $page;

                        $select = $conn->prepare("SELECT * FROM records WHERE user_id=? LIMIT $offset, $page");
                        $select->execute([$userID]);

                        foreach ($select as $selects) { ?>
                        <tr>
                            <td class="px-md-4"><?= $selects['FirstName'] ?></td>
                            <td class="px-md-4"><?= $selects['LastName'] ?></td>
                            <td class="px-md-4"><?= $selects['Course'] ?></td>
                            <td class="px-md-4"><?= $selects['Section'] ?></td>
                            <td class="px-md-1">
                                <a class="text-decoration-none " href="new.php?update&id=<?= $selects['student_id'] ?>" class="text-decoration-none">✏</a>
                                |
                                <a class="text-decoration-none" href="backend.php?delete&id=<?= $selects['student_id'] ?>" class="text-decoration-none">❌</a>
                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="container d-flex justify-content-center ">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= ceil($tItems / $page); $i++) { ?>
                        <li class="page-item">
                            <a class="page-link text-info " href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
</div>