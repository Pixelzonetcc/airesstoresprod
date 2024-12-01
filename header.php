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

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://www.instagram.com/aires_stores/" target="_blank"><i class="fab fa-instagram"></i></a>
         </div>
         <p> <a href="login.php">Entre aqui</a> | <a href="registros.php">Cadastre-se</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="index.php" class="logo">Aires Stores</a>

         <nav class="navbar">
            <a href="index.php">Início</a>
            <a href="sobre.php">Sobre nós</a>
            <a href="loja.php">Comprar</a>
            <a href="contato.php">Contato</a>
            <a href="pedidos.php">Pedidos</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="pag_procurar.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="carrinho.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>Usuário : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Sair</a>
         </div>
      </div>
   </div>

</header>
