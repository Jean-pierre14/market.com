<?php
$success = [];
?>
<?php if(count($errors) > 0):?>
    <?php foreach($errors as $error):?>
        <p class="ui message negative alert alert-danger alert-dismissible fade show" data-role="alert">
                <?php print $error;?>
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>
    <?php endforeach;?>
<?php endif;?>

<?php if(count($success) > 0):?>
    <?php foreach($success as $succ):?>
        <p class="ui message negative alert alert-danger alert-dismissible fade show" data-role="alert">
                <?php print $succ;?>
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>
    <?php endforeach;?>
<?php endif;?>
