<h1>Login</h1>
<?php $form = App\Form\Form::begin('/login', 'post') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password')->passwordType() ?>
<button type="submit" class="btn btn-primary">Login</button>
<?php App\Form\Form::end() ?>