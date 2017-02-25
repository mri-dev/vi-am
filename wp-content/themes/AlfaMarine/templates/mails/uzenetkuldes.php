<h2>Üzenete érkezett az Alfa Marine weboldalról!</h2>

<h3>Feladó</h3>
Vezetéknév: <strong><?php echo $_POST['vezeteknev']; ?></strong><br>
Kersztnév: <strong><?php echo  $_POST['keresztnev']; ?></strong><br>
E-mail cím: <strong><?php echo  $_POST['email']; ?></strong><br>
Telefonszám: <strong><?=($_POST['telefon'] == '') ? '-' : $_POST['telefon']?></strong><br>
<br>
Üzenet témája: <strong><?php echo  $_POST['subject']; ?></strong><br>
Választott témakör: <strong><?php echo  $_POST['kategoria']; ?></strong>

<h3>Üzenete</h3>
<em><?php echo $_POST['message']; ?></em>
<br><br>
@ <?php echo date('Y-m-d H:i:s'); ?>
