<!--    Einfügen der Form zum einloggen    -->
<div class='logform'>
    <form action='' method='POST'>
        <table>
            <tr>
                <td colspan='3'><h4 class='card-title'><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> Login-Bereich</h4></td>
            </tr>
            <tr>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><user><i class="fa fa-user" aria-hidden="true"></i></user></span>
                        <input type='text' class='form-control' placeholder="Benutzername" name='benutzername' value="<?php echo $this->benutzername ?>">
                    </div></td>
            </tr>
            <tr>
            </tr>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type='password' class='form-control' placeholder="Passwort" name='passwort' value="<?php echo $this->passwort ?>">
                    </div>
                </td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td><br><input type='submit' class='button_login' name='login' value='Login'></td>
            </tr>
        </table>
    </form>
    </div>
    <div class='alertlogin'>
        <div class='alert alert-<?php echo $render; ?>' role='alert'>
        <?php echo $message['alert']; ?>
        </div>
</div>
