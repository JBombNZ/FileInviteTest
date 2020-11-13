<!DOCTYPE html>
<html>
<body>

<h1>Register</h1>

<form method="post" action="/action_page.php">

  @csrf
  
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email" value=""><br>
  
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" value=""><br><br>
  
  <label for="password">Confirm Password:</label><br>
  <input type="password" id="confirm_password" name="confirm_password" value=""><br><br>
  
  <select>
  
  </select>
  
  <input type="submit" value="Submit">
  
</form>

</body>
</html> 