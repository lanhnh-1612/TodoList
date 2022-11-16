<?php require APP_ROOT . '/model/Calendar.php' ?>
<?php
$calendar = new Calendar();

if (count($data['works']) > 0) {
    foreach ($data['works'] as $work) {
        $status = 'green';
        if ($work['status'] == 'Planning') {
            $status = 'yellow';
        } elseif ($work['status'] == 'Complete') {
            $status = 'red';
        }
        $dateDiff = abs(intval($work['days_difference'])) > 0 ? abs(intval($work['days_difference'])) : 1;
        $calendar->add_event($work['name'], $work['starting_date'], $dateDiff, $status);
    }
}
?>
<?php require APP_ROOT . '/views/shared/header.php' ?>
<!--Start content -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-calendar icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>
                    <h5>Calendar</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card card main-card-custom">
        <div class="card-body">
            <?php echo $calendar; ?>
        </div>
    </div>
</div>
<!--End content -->
<?php require APP_ROOT . '/views/shared/footer.php' ?>