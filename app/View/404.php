<h1>404</h1>
<?php if(isset($exception)):?>
<p>
<?php echo $exception->getMessage();?>
</p>
<?php endif;?>