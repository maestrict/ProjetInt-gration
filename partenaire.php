<?php
session_start();
?>
<script>mesAmis()</script>
<h2>Vos partenaires </h2>
<div class="form-group">
    <td>
      <label for="user">Rechercher un partenaire :</label><input class="form-control" type="text" name="user" id="user" onchange="chercheUser(this.value);">
    </td>
    </div>
<div id="list">
    <div id="amis" class="card-group">
    </div>
</div>
