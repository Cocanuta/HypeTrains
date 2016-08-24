<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1><?= $station->Name ?></h1>
<?= $station->Date ?><br>
<?= StationType::getName($station->Type) ?>
