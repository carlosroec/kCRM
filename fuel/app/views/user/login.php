<div class="loginform">
	<div class="title"><?php echo Asset::img('logo.png'); ?></div>
    <div class="body">
   	  <form id="form1" name="form1" method="post" action="">
      	<label class="log-lab">Email</label>
        <input name="email" type="text" class="login-input-user" id="email" value=""/>
      	<label class="log-lab">Password</label>
        <input name="password" type="password" class="login-input-pass" id="password" value=""/>
        <input type="checkbox" name="remember" value="1" /> Remember Me
        <input type="submit" name="button" id="button" value="Login" class="button"/>
   	  </form>
    </div>
</div>
