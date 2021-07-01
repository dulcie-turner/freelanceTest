<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
<div id="newUser">
  <h3>Add a user</h3>
  <table>
  <form action="{{route('addUser')}}" method="POST">
    @csrf
    <tr>
      <td><label>First Name </label></td>
      <td><input type="text" name="firstname" maxlength=30 required="true"></input></td>
    </tr>
    <tr>
      <td><label>Last Name </label></td>
      <td><input type="text" name="lastname" maxlength=30 required="true"></input></td>
    </tr>
    <tr>
      <td><label>Location </label></td>
      <td><input type="text" name="location" maxlength=40 required="true"></input></td>
    </tr>
    <tr>
      <td><label>Field of Expertise </label></td>
      <td><input type="text" name="field" maxlength=60 required="true"></input></td>
    </tr>
    <tr>
      <td><label>Hourly Rate </label></td>
      <td><input type="number" name="rate" min=0 max=9999 step="0.01" required="true"></input></td>
    </tr>
    <tr><td><input type="submit" value="Submit" name="submit"></td></tr>
  </form>
  </table>
  <p>{{ $message }}</p>
</div>
</body>
</html>
