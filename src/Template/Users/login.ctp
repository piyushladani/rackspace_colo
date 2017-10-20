<?php

?>
<!DOCTYPE html>
<html>
<br>
<head>
<?= $this->Html->css('my.css') ?>
</head>

<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Login</h2>
        <?= $this->Form->create(); ?>
            <?= $this->Form->input('username');?>
            <?= $this->Form->input('password',array('type'=>'password'));?>
            
            <?= $this->Form->submit('Login',array('class'=>'button'));?>
        <?= $this->Form->end(); ?>
        <?=  $this->Html->link("Forgot Password",['controller'=>'Users','action'=>'forgotPassword'],array('style'=>'color:#2B4051;font-size:0.875em'));?>
        
    </div>
    
</div>

</html>