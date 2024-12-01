<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">

   <title>Sobre</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Sobre a loja:</h3>
   <p> <a href="index.php">Início</a> </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/banner-1.png" alt="">
      </div>

      <div class="content">
         <h3>Por que nos escolher?</h3>
         <p>Escolher a nossa loja é apoiar o empoderamento feminino e incentivar pequenos 
            empreendedores. Somos uma marca nova no mercado, comprometida em oferecer qualidade,
             conforto e estilo para mulheres que buscam mais do que apenas um sapato, 
             mas uma forma de expressão. Ao escolher nossos produtos, você não só adquire 
             algo único, mas também faz parte de uma comunidade que valoriza a independência 
             e a inovação.</p>
         <a href="contato.php" class="btn">Nos mande uma mensagem!</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title"> Avaliações dos clientes: </h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cliente1.jpg" alt="">
         <p>Eu simplesmente amei o meu par de sapatos! 
            São super confortáveis e estilosos. 
            Comprei para um evento importante e recebi tantos elogios.
             Além disso, fico feliz em apoiar uma loja que valoriza o 
             empreendedorismo feminino!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Luciana, 32 anos. </h3>
      </div>

      <div class="box">
         <img src="images/cliente2.jpeg" alt="">
         <p> A qualidade dos sapatos é impressionante! 
            O atendimento é maravilhoso, 
            e é incrível saber que estou contribuindo para o sucesso de 
            uma marca nova e inovadora. Super recomendo! </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ana, 27 anos. </h3>
      </div>

      <div class="box">
         <img src="images/cliente3.jpeg" alt="">
         <p>Encontrei exatamente o que procurava: elegância e conforto 
            em um só par de sapatos. Fiquei encantada com o atendimento 
            personalizado e o cuidado com os detalhes. 
            Voltarei com certeza para mais compras!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Joana, 35 anos. </h3>
      </div>


</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>