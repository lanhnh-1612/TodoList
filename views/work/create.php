<?php require APP_ROOT . '/views/shared/header.php' ?>
<!--Start content -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-plus icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>
                    <h5>Create work</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card card main-card-custom">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" novalidate="" action="<?php echo BASE_URL; ?>/work/store" accept-charset="UTF-8" id="create_exhibition_form" name="create_exhibition_form" class="">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Work name (*)</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="255" value="<?php echo (isset($data['dataOld']['name']) ? $data['dataOld']['name'] : false) ?>" placeholder="Work name" required>
                            <?php echo (isset($data['errors']) && array_key_exists('name', $data['errors']) ? '<span style="color:red">' . $data['errors']['name'] . '</span>' : false) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Starting date (*)</label>
                            <input type="date" class="form-control" id="" name="starting_date" maxlength="255" value="<?php echo (isset($data['dataOld']['starting_date']) ? $data['dataOld']['starting_date'] : false) ?>" required>
                            <?php echo (isset($data['errors']) && array_key_exists('starting_date', $data['errors']) ? '<span style="color:red">' . $data['errors']['starting_date'] . '</span>' : false) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Ending date (*)</label>
                            <input type="date" class="form-control" id="" name="ending_date" maxlength="255" value="<?php echo (isset($data['dataOld']['ending_date']) ? $data['dataOld']['ending_date'] : false) ?>" required>
                            <?php echo (isset($data['errors']) && array_key_exists('ending_date', $data['errors']) ? '<span style="color:red">' . $data['errors']['ending_date'] . '</span>' : false) ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Status (*)</label>
                            <select class="custom-select" id="status" name="status">
                                <option value="">--All status--</option>
                                <?php foreach ($data['statuses'] as $value) { ?>
                                    <option <?php if (isset($data['dataOld']['status']) && $data['dataOld']['status'] == $value) echo 'selected'; ?> value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php } ?>
                            </select>
                            <?php echo (isset($data['errors']) && array_key_exists('status', $data['errors']) ? '<span style="color:red">' . $data['errors']['status'] . '</span>' : false) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button onclick="history.back()" class="mb-2 mr-2 btn-icon btn-pill btn btn-outline-secondary"><i class="fa fa-undo btn-icon-wrapper"></i> Return</button>
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-outline-success"><i class="fa fa-plus btn-icon-wrapper"> </i> Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End content -->
<?php require APP_ROOT . '/views/shared/footer.php' ?>