<?php

use yii\helpers\Html;

$this->title = 'My Groups';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="group-list">
    <h1>My Groups</h1>
    <h4>Click on a group to view its details</h4>
    <div class="list-group">
        <?php
            foreach ($list as $list) {
                ?>


            <a href="../group/info?id=<?= $list->GROUP_ID?>&num=<?= $phoneNumber ?>" class=list-group-item>
                <h4 class="list-group-item-heading"><?= $list->GROUP_NAME ?></h4>
                <p class="list-group-item-text">
                    <?= $list->GROUP_DESCRIPTION ?>
                </p>
            </a>

            <?php
        }
        ?>
    </div>   
</div><!-- group-list -->
