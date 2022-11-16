<?php require APP_ROOT . '/views/shared/header.php' ?>
<!--Start content -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list-ul icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="mr-2">
                    List work
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?php echo BASE_URL; ?>/work/create" class="mb-2 mr-2 btn-icon btn btn-success custom-btn-add" id="btn_create">Create</a>
            </div>
        </div>
    </div>
    <form action="" method="GET" id="form-search">
        <div class="col">
            <div class="row">
                <div class="form-group">
                    <label for="name-search">Name work :</label>
                    <input type="search" value="<?php if (isset($_GET['name']))  echo $_GET['name']; ?>" class="form-control" id="name-search" name="name" placeholder="Work name" aria-controls="example">
                </div>
                <div class="form-group ml-2">
                    <label for="">Starting Date :</label>
                    <input class="form-control" name="starting_date" type="date" id="datepicker" value="<?php if (isset($_GET['starting_date'])) echo $_GET['starting_date']; ?>" maxlength="20">
                </div>
                <div class="form-group ml-2">
                    <label for="">Ending Date :</label>
                    <input class="form-control" name="ending_date" type="date" id="datepicker" value="<?php if (isset($_GET['ending_date'])) echo $_GET['ending_date']; ?>" maxlength="20">
                </div>
                <div class="form-group ml-2">
                    <label for="status">Status :</label>
                    <select class="custom-select" id="status" name="status">
                        <option value="">--All status--</option>
                        <?php foreach ($data['statuses'] as $value) { ?>
                            <option <?php if (isset($_GET['status']) && $_GET['status'] == $value) echo 'selected'; ?> value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group ml-2 mt-4">
                    <button class="btn btn-info btn-search"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <div class="main-card card">
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">
                <?php if (empty($data['works'])) { ?>
                    <div class="panel-body text-center empty-none">
                        <img src="/admins/assets/images/empty.png" />
                    </div>
                <?php } else { ?>
                    <table class="table table-striped " id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Work name</th>
                                <th>Starting date</th>
                                <th>Ending date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['works'] as $key => $value) { ?>
                                <tr>
                                    <td><?php echo ($key + 1) ?></td>
                                    <td><?php echo ($value['name']) ?></td>
                                    <td><?php echo ($value['starting_date']) ?></td>
                                    <td><?php echo ($value['ending_date']) ?></td>
                                    <td><?php echo ($value['status']) ?></td>
                                    <td>
                                        <div class=" w-100">
                                            <a class="pull-right mb-2 mr-2 btn-icon btn-icon-only btn-shadow btn-dashed btn btn-outline-warning" href="<?php echo BASE_URL; ?>/work/delete?id=<?php echo $value['id']; ?>" title="Delete" onclick="return confirm('You want delete ?')">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>/work/edit?id=<?php echo $value['id']; ?>" class="pull-right mb-2 mr-2 btn-icon btn-icon-only btn-shadow btn-dashed btn btn-outline-primary" title="Update">
                                                <span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>

        <div class="panel-footer">
            <div class="col-12">
                <div class="pagination pull-right">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End content -->
<?php require APP_ROOT . '/views/shared/footer.php' ?>