<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <?php echo css_asset('bootstrap.min.css'); ?>

    <!-- Custom styles for this template -->
    <?php echo css_asset('signin.css'); ?>
  </head>

  <body>

    <div class="container">
      <?php
      echo form_open('user/check_login',array('class'=>'form-signin'));
      ?>
        <h2 class="form-signin-heading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Satiporn Shop</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" name='user_name' placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name='user_password' placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
      <?php
      if(empty($message)){

      }else{
        echo "<p align='center'>",$message,"</p>";
      }
      ?>
    </div> <!-- /container -->

  </body>
</html>
