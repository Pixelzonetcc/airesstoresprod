<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('Erro na query');
   $message[] = 'Atualizamos a quantidade do seu carrinho!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('Erro na query');
   header('location:carrinho.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Erro na query');
   header('location:carrinho.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">
   
   <title>Carrinho</title>

   <!-- Link para o Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para o arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Carrinho de Compras</h3>
   <p><a href="index.php">Início</a> / Carrinho</p>
</div>

<section class="shopping-cart">

   <h1 class="title">Produtos Adicionados</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Erro na query');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="carrinho.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Deseja excluir este produto do carrinho?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price">R$<?php echo $fetch_cart['price']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="Atualizar" class="option-btn">
         </form>
         <div class="sub-total"> Subtotal: <span>R$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">Seu carrinho está vazio</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="carrinho.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Deseja excluir todos os itens do carrinho?');">Apagar Tudo</a>
   </div>

   <div class="cart-total">
      <p>Total: <span>R$<?php echo $grand_total; ?>/-</span></p>
      <div class="flex">
         <a href="loja.php" class="option-btn">Continuar Comprando</a>
         <a href="sair.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Finalizar Compra</a>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Link para o arquivo JS personalizado -->
<script src="js/script.js"></script>

</body>
</html>
