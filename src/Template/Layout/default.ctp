<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Welcome to DE-CIX Colocation';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('my1.css') ?>
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?=$this->Html->script('//code.jquery.com/jquery-1.10.2.js')?>
   <?= $this->Html->script('//code.jquery.com/ui/1.11.4/jquery-ui.js')?>
   <?= $this->Html->css('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css')?>
</head>
<body>

<h2 align="center" ><a href="http://localhost:8888/colocation/colocation-app/colocations">DE-CIX Colocation</a></h2>
    
 <div class="myview">   
    <?php if($loggedIn):?>
    <?= $this->Html->image("logo".$this->request->session()->read('imgrandd').".png", array('width'=>'85px','hspace'=>'27'),['fullBase' => true]);?>
    <?= "Welcome to ".$Houses[$this->request->session()->read('imgrandd')]. ", ".$this->request->session()->read('Auth.User.name'). " !" ?>
    <pre align="right" ><?= $this->request->session()->read('Auth.User.name')." " ?></pre>
    <?php endif;?>
</div>

    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <?php if($loggedIn):?>
            <li class="name">
            <h1><a href="http://localhost:8888/colocation/colocation-app/colocations">Home</a></h1>
            </li><li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
            <?php endif;?>

        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if($loggedIn):?>

                <li><?= $this->Html->link('Logout', ['controller'=>'users','action'=>'logout']);?></li>
                <?php else: ?>
                <li><?= $this->Html->link('Register', ['controller'=>'users','action'=>'register']);?></li>
                <li><?= $this->Html->link('Login', ['controller'=>'users','action'=>'login']);?></li>
                <?php endif;?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
