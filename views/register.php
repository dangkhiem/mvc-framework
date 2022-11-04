<h1>Register</h1>
<?php $form = App\Form\Form::begin('/register', 'post') ?>
<?php echo $form->field($model, 'firstname') ?>
<?php echo $form->field($model, 'lastname') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password')->passwordType() ?>
<?php echo $form->field($model, 'password_confirmation')->passwordType() ?>
<button type="submit" class="btn btn-primary">Register</button>
<?php App\Form\Form::end() ?>