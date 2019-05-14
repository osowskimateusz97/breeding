<?php
//--- początek formularza ---
if(empty($_POST['submit'])) {
?>
<table>
<form action="" method="post">
<tr>
  <td>Imię i Nazwisko:</td>
  <td><input type="text" name="name"/></td>
</tr>

<tr>
  <td>E-Mail:</td>
  <td><input type="text" name="email"/></td>
</tr>

<tr>
  <td>Treść wiadomości:</td>
  <td><textarea name="message"></textarea></td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td><input type="submit" name="submit" value="Wyślij formularz"/></td>
</tr>
</form>
</table>
<?php
} else {

//twoje dane
$email = 'osowski.mateuszz@gmail.com';

//dane z formularza
$formName = $_POST['name'];
$formEmail = $_POST['email'];
$formPhone = $_POST['phone'];
$formText = $_POST['message'];

if(!empty($formName) && !empty($formEmail) && !empty($formText)) {

//--- początek funkcji weryfikującej adres e-mail ---
function checkMail($checkmail) {
  if(filter_var($checkmail, FILTER_VALIDATE_EMAIL)) {
    if(checkdnsrr(array_pop(explode("@",$checkmail)),"MX")){
        return true;
      }else{
        return false;
      }
  } else {
    return false;
  }
}
//--- koniec funkcji ---
if(checkMail($formEmail)) {
  //dodatkowe informacje: ip i host użytkownika
  $ip = $_SERVER['REMOTE_ADDR'];
  $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 
  //tworzymy szkielet wiadomości
  //treść wiadomości
  $mailText = "Treść wiadomości:\n$formText\nOd: $formName, $formEmail ($ip, $host)";
 
  //adres zwrotny
  $mailHeader = "From: $formName <$formEmail>";
 
  //funkcja odpowiedzialna za wysłanie e-maila
  @mail($email, 'Formularz kontaktowy', $mailText, $mailHeader) or die('Błąd: wiadomość nie została wysłana');
 
  //komunikat o poprawnym wysłaniu wiadomości
  echo 'Wiadomość została wysłana';
} else {
  echo 'Adres e-mail jest niepoprawny';
}

} else {
  //komunikat w przypadku nie powodzenia
  echo 'Wypełnij wszystkie pola formularza';
}

//--- koniec formularza ---
}
?>
