<?php
  include("header.php");
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <style>
    body {
        background-color:#e0e1dd ;
    }
</style>

</head>
<div class="content">
    <div class="owl-carousel owl-theme">

        <?php

        $numItems = 5;

        for ($i = 0; $i < $numItems; $i++) {
            echo '<div class="item">
                    <img src="' . $i . '.png" alt="image' . ($i + 1) . '">
                    <div class="text">
                        <h1 style="color:orange">Passer vos vacances</h1>
                        <p style="font-family: "Playfair Display", serif;">Plongez dans le luxe dès maintenant. Découvrez notre sélection exclusive d\'hôtels d\'exception et réservez votre escapade en quelques clics. Bienvenue dans un monde où le confort rencontre l`\'excellence</p>
                        <div class="flex">
                            
                        </div>
                    </div>
                </div>';
        }
        ?>

    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    dots:false,
    nevText:["<i class ='fa fa-chevron-left'></i>","<i class ='fa fa-chevron-right'></i>"],
    responsive:{
        0:{items:1},
        768:{items:1},
        1000:{items:1}}})
     </script>
    <!-- check in -->
   
    <form method="post" action="traitement_formulaire.php" class="cheek">
        <div class="row">
            <label for="checkin">Check-in</label>
            <input type="date" id="checkin" name="checkin">
        </div>
        <div class="row">
            <label for="checkout">Check-out</label>
            <input type="date" id="checkout" name="checkout">
        </div>
        <div class="row">
            <label for="adultes">Adultes</label>
            <select id="adultes" name="adultes">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="row">
            <label for="enfants">Enfants</label>
            <select id="enfants" name="enfants">
                <option value="v1">1</option>
                <option value="v2">2</option>
                <option value="v3">3</option>
                <option value="v4">4</option>
                <option value="v5">5</option>
            </select>
        </div>
        <div class="row">
            <input type="submit" value="Chercher" class="firstbtn">
        </div>
    </form>



    <!-- Contact us -->
    </div id="Contact" style="display:flex;">
    <div id="map" style="display: inline;" >
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3436.3883736372136!2d-9.6970437!3d30.5383295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b3b82f9a6bc1%3A0x781dd27a63fe1256!2sHotel%20Riu%20Palace%20Tikida%20Taghazout!5e0!3m2!1sfr!2sma!4v1702662329963!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div> 
    <div id="Contact" style="float: right; width: 42%; margin-top:100px;">
        <h4>Contact</h4>
        <p class="p">avez vous des questions ? Faites-le nous savoir.</p><br>
        <i class="fas fa-location-dot"></i>
        <h4>Adresse</h4>
        <p class="p">Taghazout Bay, Agadir 80022</p><br>
        <i class="far fa-envelope-open"></i>
        <h4>Email</h4>
        <p class="p">RMH@e-polytechnique.ma</p><br>
        <i class="fas fa-phone"></i>
        <h4>Télèphone</h4>
        <p class="p">+(212)500556699</p><br>
    </div>
    <!-- Services -->
    <div id="Srv">
      <h2>Nos Service :</h2>
    <div class="services" >
        <!-- Service Wi-Fi-->
        <div class="service">
          <i class="fa-solid fa-wifi"></i>
          <h3>Wi-Fi à dépenses élevées</h3>
          <p>Profitez d'une connexion Wi-Fi haut débit dans tout l'établissement pour rester connecté pendant votre séjour.</p>
        </div> 
        <!-- Service Restaurant -->
        <div class="service">
            <i class="fa-solid fa-utensils"></i>
          <h3>Restaurant</h3>
          <p>Découvrez notre restaurant qui propose une variété de plats délicieux préparés par nos chefs talentueux.</p>
        </div>
        <!-- Service Place de parking -->
        <div class="service">
        <i class="fa-solid fa-square-parking"></i>
          <h3>Place de parking</h3>
          <p>Nous offrons un espace de stationnement sécurisé pour votre véhicule tout au long de votre séjour.</p>
        </div>
        <!-- Service SPA -->
          <div class="service">
        <i class="fa-solid fa-spa"></i>
          <h3>Centre de Spa</h3>
          <p>Relaxez-vous et revitalisez-vous dans notre centre de spa avec des traitements apaisants et revigorants.</p>
          </div>
        <!-- Service Piscine -->
          <div class="service">
            <i class="fa-solid fa-person-swimming"></i>
              <h3>Piscine</h3>
              <p>Profitez de notre piscine pour vous rafraîchir et vous détendre dans un cadre paisible et agréable.</p>
          </div>
        <!-- Service Sport -->
          <div class="service">
            <i class="fa-solid fa-dumbbell"></i>
              <h3>Centre Fitness</h3>
              <p>Maintenez votre routine d'exercice dans notre centre fitness équipé des derniers équipements sportifs.</p>
          </div>
      </div>  
    </div>
    
      <!-- About us -->
    <div id="histoire1">
        <h2>Notre Histoire :</h2>
      <div class="histoire-container">
        <div class="histoire-text">
            <p>Depuis son inauguration il y a plusieurs décennies, notre hôtel a été le témoin de moments magiques et de souvenirs inoubliables. Niché dans un endroit pittoresque, notre hôtel a commencé son voyage comme une retraite tranquille, offrant une échappée paisible aux voyageurs en quête de sérénité.</p>
            <p>Au fil des années, notre hôtel a évolué pour devenir une destination de choix, alliant élégance intemporelle et commodités modernes. Chaque coin de notre établissement raconte une histoire, imprégnée de l'essence de l'hospitalité et du dévouement envers nos clients.</p>
            <p>Notre équipe, passionnée par le service exceptionnel, s'efforce de créer une expérience unique pour chaque visiteur. Que ce soit les voyageurs d'affaires pressés ou les vacanciers en quête de détente, notre hôtel est l'endroit où les rêves de séjours parfaits prennent vie.</p>
            <p>Aujourd'hui, notre histoire se poursuit avec l'engagement continu envers l'excellence. Nous sommes fiers de faire partie des souvenirs de nos clients et sommes impatients de continuer à écrire notre histoire avec vous, chaque jour qui passe.</p>
        </div>
        <div class="histoire-image-container">
            <img class="histoire-image" src="3.png" alt="">
        </div>
    </div>
    </div>
    
    <!-- Galerie -->
    <h2 id="title1">Galerie :</h2>
    <div class="container3">
        <div class="slider-wrapper">
          <button id="prev-slide" class="slide-button material-symbols-rounded">
            chevron_left
          </button>
          <ul class="image-list">
            <img class="image-item" src="image/i1.png" alt="i1" />
            <img class="image-item" src="image/i2.png" alt="i2" />
            <img class="image-item" src="image/i3.png" alt="i3" />
            <img class="image-item" src="image/i4.png" alt="i4" />
            <img class="image-item" src="image/i5.png" alt="i5" />
            <img class="image-item" src="image/i6.png" alt="i6" />
            <img class="image-item" src="image/i7.png" alt="i7" />
            <img class="image-item" src="image/i8.png" alt="i8" />
            <img class="image-item" src="image/i9.png" alt="i9" />
          </ul>
          <button id="next-slide" class="slide-button material-symbols-rounded">
            chevron_right
          </button>
        </div>
        <div class="slider-scrollbar">
          <div class="scrollbar-track">
            <div class="scrollbar-thumb"></div>
          </div></div></div>

        <script src="javascript.js"></script>
        <?php
        include("footer.php");
        ?>
</body>
</html>