<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>
  <div id="newUser">
    <h3>Add User</h3>
    <table>
      <form action="{{route('formSubmit')}}" method="POST">
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
          <td><label>Hourly Rate (GBP)</label></td>
          <td><input type="number" name="rate" min=0 max=9999 step="0.01" required="true"></input></td>
        </tr>
        <tr>
          <td><input type="submit" value="Submit" name="submit"></td>
        </tr>
      </form>
    </table>
    <p>{{ $message }}</p>
  </div>
<br>

  <div id="viewUser">

    <h3>View Users</h3>

    <form action="{{route('formSubmit')}}" method='POST'>
      @csrf
      <label>Select a currency: </label>
      <select name="currency">
        <option value="gbp">GBP </option>
        <option value="usd">USD</option>
        <option value="eur">EUR</option>
      </select>
      <select name="rate_type">
        <option value="local">Local </option>
        <option value="third">Third-party</option>
      </select>
      <input type="submit" value="Submit" name="submit">
    </form>

    <table>
      <tr style="font-weight:bold">
        <td> First name </td>
        <td> Last name </td>
        <td> Location </td>
        <td> Field of Expertise </td>
        <td> Hourly Rate ({{$currency}}) </td>
      </tr>
      @foreach ($user_data as $user)
      <tr>
        <td> {{$user->firstname}} </td>
        <td> {{$user->lastname}} </td>
        <td> {{$user->location}} </td>
        <td> {{$user->field}} </td>
        <td> {{$user->rate * $rate}} </td>
      </tr>
      @endforeach


    </table>

  </div>
</body>

</html>