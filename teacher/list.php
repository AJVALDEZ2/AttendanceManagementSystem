<?php
if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."index.php");
}
?>

<section id="feature" class="transparent-bg">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2 class="page-header">List of teachers</h2>
        </div>

        <div class="row">
            <div class="features">
                <form class="wow fadeInDown" action="controller.php?action=delete" Method="POST">
                    <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th width="14%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $mydb->setQuery("SELECT * FROM `tblteacher`");
                            $cur = $mydb->loadResultList();

                            foreach ($cur as $result) {
                                echo '<tr>';
                                echo '<td>' . $result->TeacherID . '</td>';
                                echo '<td>' . $result->Firstname . ', ' . $result->Lastname . ' ' . $result->Middlename . '</td>';
                                echo '<td>' . $result->Gender . '</td>';
                                echo '<td>' . $result->Address . '</td>';
                                echo '<td>' . $result->ContactNo . '</td>';
                                echo '<td align="center"> 
                                        <a title="View Information" href="index.php?view=view&id=' . $result->ID . '" class="btn btn-info btn-xs">View <span class="fa fa-info-circle fw-fa"></span></a>
                                        <a title="Update teacher" href="index.php?view=edit&id=' . $result->ID . '" class="btn btn-info btn-xs">Edit <span class="fa fa-pencil fw-fa"></span></a>
                                      </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="index.php?view=add" class="btn btn-primary"><i class="fa fa-plus"></i> New</a>
                    </div>
                </form>
            </div><!--/.features-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#feature-->
