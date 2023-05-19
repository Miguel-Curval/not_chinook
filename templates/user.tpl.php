<?php declare(strict_types = 1); ?>

<?php function drawProfileForm(User $user) { ?>
<h2>Profile</h2>
<form action="../actions/action_edit_profile.php" method="post" class="profile">

<label for="username">Username:</label>
<input id="username" type="text" name="username" value="<?=$user->username?>">

<label for="name">Name:</label>
<input id="name" type="text" name="name" value="<?=$user->name?>">

<label for="email">Email:</label>
<input id="email" type="text" name="email" value="<?=$user->email?>">  

<label for="password">Password:</label>
<input id="password" type="password" name="password">  

<label for="repeat_password">Repeat Password:</label>
<input id="repeat_password" type="password" name="repeat_password">
  
  <button type="submit">Save</button>
</form>
<?php } ?>

<?php function drawRegistrationForm() { ?>
<h2>Profile</h2>
<form action="../actions/action_register.php" method="post" class="profile">

<label for="username">Username:</label>
<input id="username" type="text" name="username">

<label for="name">Name:</label>
<input id="name" type="text" name="name">

<label for="email">Email:</label>
<input id="email" type="text" name="email">  

<label for="password">Password:</label>
<input id="password" type="password" name="password">  

<label for="repeat_password">Repeat Password:</label>
<input id="repeat_password" type="password" name="repeat_password">
  
  <button type="submit">Save</button>
</form>
<?php } ?>