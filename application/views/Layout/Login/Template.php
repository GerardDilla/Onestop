<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header Content -->
    <title><?php if ($Title) echo $Title; ?></title>
    <?php if ($Header) echo $Header; ?>
    <?php if ($Script) echo $Script; ?>
</head>

<body>
<div class="content">
<?php if ($Body) echo $Body; ?>
<?php if ($Footer) echo $Footer; ?>
</div>
</body>

</html>