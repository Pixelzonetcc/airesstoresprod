<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Já adicionado ao carrinho!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Produto adicionado ao carrinho!';
   }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">

   <title>Início</title>

   <!-- link para o cdn do font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- link para o arquivo css personalizado -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Dê um novo passo no seu estilo!</h3>
      <p>Conforto, qualidade e estilo para todos os seus passos.</p>
      <a href="sobre.php" class="white-btn">Descubra mais</a>
   </div>

</section>
<br>
<br>
<br>
<br>
<section class="products">

   <h1 class="title">Produtos recentes</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">R$<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Adicionar ao carrinho" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">Nenhum produto adicionado ainda</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="loja.php" class="option-btn">Carregar mais</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/logo.png" alt="">
      </div>

      <div class="content">
         <h3>Sobre nós</h3>
         <p>Bem-vindo à nossa loja, um espaço dedicado à mulher que busca elegância, conforto e um toque de personalidade. Esta é uma empresa criada por uma mulher independente com o objetivo de oferecer sapatos de alta qualidade que atendem às necessidades de todas as mulheres, em todas as ocasiões.</p>
         <a href="sobre.php" class="btn">Leia Mais</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
   <br>
   <br>
   <br>
   <br>
      <h3>Alguma dúvida?</h3>
      <p>Tem alguma dúvida ou precisa de ajuda para escolher o sapato perfeito? Estamos aqui para você! Não hesite em nos enviar uma mensagem, seja para tirar dúvidas sobre nossos produtos, receber dicas de estilo ou simplesmente para bater um papo. </p>
      <a href="contato.php" class="white-btn">Nos mande uma mensagem</a>
   <br>
   <br>
   <br>
   <br>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- link para o arquivo js personalizado -->
<script src="js/script.js"></script>

</body>
</html>
