<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo"><span>Aires Store</span> Painel</a>

      <nav class="navbar">
         <a href="admin_page.php">Início</a>
         <a href="admin_produtos.php">Produtos</a>
         <a href="admin_pedidos.php">Pedidos</a>
         <a href="admin_usuarios.php">Usuários</a>
         <a href="admin_contatos.php">Mensagens</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Usuário: <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Sair</a>
         <div>Novo? <a href="login.php">Entre aqui</a> | <a href="registros.php">Registre-se agora</a></div>
      </div>

   </div>

</header>
