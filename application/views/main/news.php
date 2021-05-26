<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'head.php';?>
</head>
<body class="container">
<h1>News Demo</h1>
<table class="table table-bordered table-hover">
    <tr>
        <th>title</th>
        <th>short_content</th>
        <th>content</th>
        <th>date</th>
        <th>start_date</th>
        <th>end_date</th>
        <th>cover_img</th>
    </tr>
    <?php
    foreach ($news as $item) {
        ?>

        <tr>
            <td><?= _h($item->title) ?></td>
            <td><?= _h($item->short_content) ?></td>
            <td><?= ($item->content) ?></td>
            <td><?= _h($item->date) ?></td>
            <td><?= _h($item->start_date) ?></td>
            <td><?= _h($item->end_date) ?></td>
            <td><?php if (!empty($item->cover_img)) { ?>
                    <img src="<?= assets_url($item->cover_img) ?>">
                <?php } ?></td>
        </tr>
        <?php
    }

    ?>
</table>

<div class="text-center">
    <?= $page_links ?>
</div>
<div class="col-md-12">
    <a class="btn btn-default" href="<?=front_url('home/')?>">Back</a>
</div>

<?php include_once 'footer.php' ?>

<?php include_once 'script.php' ?>
</body>
</html>