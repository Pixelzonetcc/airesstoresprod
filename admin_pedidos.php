<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('Erro na query');
   $message[] = 'Status de pagamento atualizado com sucesso!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Erro na query');
   header('location:admin_pedidos.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">

   <title>Pedidos</title>

   <!-- Link para Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">Pedidos realizados</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Erro na query');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p>ID de usuário: <span><?php echo $fetch_orders['user_id']; ?></span></p>
         <p>Feito em: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
         <p>Nome: <span><?php echo $fetch_orders['name']; ?></span></p>
         <p>Número: <span><?php echo $fetch_orders['number']; ?></span></p>
         <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
         <p>Endereço: <span><?php echo $fetch_orders['address']; ?></span></p>
         <p>Total de produtos: <span><?php echo $fetch_orders['total_products']; ?></span></p>
         <p>Preço total: <span>R$<?php echo $fetch_orders['total_price']; ?>/-</span></p>
         <p>Método de pagamento: <span><?php echo $fetch_orders['method']; ?></span></p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pendente">Pendente</option>
               <option value="completo">Completo</option>
            </select>
            <input type="submit" value="Atualizar" name="update_order" class="option-btn">
            <a href="admin_pedidos.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Deseja excluir este pedido?');" class="delete-btn">Excluir</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Nenhum pedido foi realizado ainda!</p>';
      }
      ?>
   </div>

</section>

<!-- Link para arquivo JS personalizado -->
<script src="js/admin_script.js"></script>

</body>
</html>
