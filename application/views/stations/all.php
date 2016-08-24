<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1>All Stations</h1><br>
<?php foreach($stations as $station): ?>
<?= $station->Name ?> - <?= $station->Date ?> - <?= $station->Type ?> - <?= $station->Tags ?><br>
<?php endforeach; ?>
