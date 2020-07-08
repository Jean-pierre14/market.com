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