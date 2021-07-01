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


<div id="viewUser">
  <h3>All users</h3>
  <table>
    <tr style="font-weight:bold">
      <td> First name </td>
      <td> Last name </td>
      <td> Location </td>
      <td> Field of Expertise </td>
      <td> Hourly Rate </td>
    </tr>
    @foreach ($user_data as $user)
    <tr>
      <td> {{$user->firstname}} </td>
      <td> {{$user->lastname}} </td>
      <td> {{$user->location}} </td>
      <td> {{$user->field}} </td>
      <td> {{$user->rate}} </td>
    </tr>
    @endforeach


  </table>

  <form action="{{route('changeCurrency')}}" method='POST'>
  @csrf
  <label>Select a currency: </label>
  <select name="currency">
    <option value="gbp">GBP</option>
  </form>
</div>
</body>
</html>
