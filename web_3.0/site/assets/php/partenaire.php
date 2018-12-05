<?php
session_start();
?>
<script>mesAmis()</script>
<label for="user">recherche</label><input type="text" name="user" id="user" onchange="chercheUser(this.value);">
<div id="list">
    <div id="amis" class="card-group">
    </div>
</div>
