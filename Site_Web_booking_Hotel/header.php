<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['pwd'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }


    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);


    $query = "SELECT id_clt, nom, pwd FROM client WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pwd = $row['pwd'];
        $_SESSION['user_id'] = $row['id_clt'];
        $_SESSION['name'] = $row['nom'];
        if ($email === "admin@gmail.com" && $pwd === "root") {
            $_SESSION['is_admin'] = true;
            header('Location:admin.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        echo "Identifiants incorrects.";
    }
    if (isset($_SESSION['user_id']) && isset($_SESSION['name']) ) {
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<script>alert("Nouvel enregistrement créé avec succès!");</script>';
        }
    } 
      
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /*log in*/
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        .popup{
            position:absolute;
            top: 150%;
            left: 50%;
            opacity: 0;
            transform: translate(-50%,-50%) scale(1.25);
            width: auto;
            padding: 20px 30px;
            background: #f1f4f8;
            box-shadow: 2px 2px 5px 5px rgba(0,0,0,0.15);
            border-radius: 10px;
            transition: top 0ms ease-in-out 200ms,
            opacity 200ms ease-in-out 0ms,
            transform 20ms ease-in-out 0ms;}
        .popup.active {
    top: 50%;
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
    transition: top 0ms ease-in-out 200ms, opacity 200ms ease-in-out 0ms, transform 20ms ease-in-out 0ms;
    z-index: 1000; 
}
        .popup .close-btn{
            position: absolute;
            top: 10px;
            right: 10px;
            width: 15px;
            height: 15px;
            background:#888;
            color: #eee;
            text-align: center;
            line-height: 15px;
            border-radius: 15px;
            cursor: pointer;
        }
        .popup #form-element {
    display: flex;
}

        .popup .form .form-element label{
            font-size: 14px;
            color: #222;
        }
        .inp{
            width: 300px;
            height: 40px;
            margin-top: 5px;
            display: block;
            padding: 10px;
            outline: none;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .popup .form .form-element input[type="email"],
        .popup .form .form-element input[type="password"]{
            margin-top: 5px;
            display: block;
            padding: 10px;
            outline: none;
            border: 1px solid #aaa;
            border-radius: 5px;

        }
        .popup .form .form-element input[type="checkbox"]{
            margin-right: 5px;
        }
        .popup .form .form-element button{
            width: 150px;
            height: 40px;
            border: none;
            outline: none;
            font-size: 16px;
            background: #3d5584;;
            color: #f5f5f5;
            border-radius: 10px;
            cursor: pointer;
           margin-left: 50%;
        }
        .popup .form .form-element a {
            display: block;
            text-align: right;
            font-size: 15px;
            color: #1a79ca;
            text-decoration: none;
            font-weight: 600;

        }
        /*header*/
        .lien{text-decoration: none;
    color: #3d5584;}
li{
    list-style: none;}
.flex{
    display: flex;}
.flex_space{
    display:flex ;
    justify-content: space-between;}

.firstbtn{
   padding: 15px 40px;
   background:#3d5584;
   font-weight: bold;
   color: white;}
header{
    position: sticky;
    top: 0;
    z-index: 1000;
    height: 8vh;
    line-height: 8vh;
    padding: 0 20px;
    background-color: #e0e1dd;}
header ul{
    display: inline-block;}
header ul li{
    display: inline-block;
    margin-top: -5px;
    text-transform: uppercase;}
header ul li a {
    margin:10px;
    transition: 0.5s;}
header ul li a:hover{
    color: #02060a;}
header i{
    margin: 0 20px;}
header button{
    margin: auto;
    padding: 13px 40px;}
/*sign in */
.popup .form-element .form1,
.popup .form-element .form2 {
    flex: 1;
    padding-right: 50px;
}
        .popup .form h2{
            text-align: center;
            color: #222;
            margin: 10px 0px 20px;
            font-size: 25px;
        }

#my_modal{
    position: fixed;
    top: 8%;
    left: 20%;
    right:-50%;
    z-index: 1000;
    display: none;
}
#my_modal.open{
    display: block !important;
}
.my_centent{
    width: 8%;
    height: auto;
    padding: 30px;
    box-sizing: border-box;
    padding: 0 10px 0 10px;
    background:white;
    position: absolute;
    top: 0%;
    left: 53.5%;
    background-color: #e0e1dd;
}
.my_centent a{
    text-decoration: none;
    color: #334b72;
}
    </style>
</head>
<body>
     <!-- Navigateur -->
     <header>
        <div class=" flex_space">
        <div id="logo">
        <h3><span style="color: black;">HOTEL</span><span style="color: orange;">RMH<i class="fa-solid fa-crown" style="color: orange;margin-left:auto"></i></span></h3>

        </div>
        <div id="links">
            <ul id="menulist">
            <li><a class="lien" href="index.php" target="_self">Accueil</a></li>
            <li><a class="lien" href="rooms.php">Chambres</a></li>
        
            <li><a class="lien" href="#Srv">Services</a></li>
            <li><a class="lien" href="#Contact">Contacter nous</a></li>
            <li><a class="lien" href="#histoire1">A propos</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
  
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) {
        echo ' <li><a href="admin.php" style="text-decoration:none;color: #3d5584;">Espace</a></li>';
    }
}?>
                    
                    <?php
                   
                    if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
                        echo '<li>' . $_SESSION['name'] . '</li>';
                        echo '<li style="position: relative; margin-left: 20px; margin-right: 20px;">
                                <div id="user-avatar" style="cursor: pointer;">
                                <i class="fa-solid fa-user"  onclick="toggle()" ></i>
                                </div>
                              </li>';
                    } else {
                        echo '<li><button id="show-login" class="firstbtn"  " >Se connecter</button></li>';
                        echo '<li><button id="show-signin" class="firstbtn">Inscription</button></li>';
                    }
                    ?>
            </ul>
        </div>
     </div> 
    </header><br>
    <div id="my_modal">
                        <div class="my_centent">
                        <a href="javascript:void(0)" onclick='toggle()'></a>
                        <a href="profile.php">Profile</a>
                        <a href="logout.php">Déconnexion</a><br>
                        </div>
                    </div>
    <!-- log in -->
    <form action="" method="post">
         <div class="popup">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2 style="color:#3d5584">Log in</h2>
            <div class="form-element">
                Email <br>
                <input class="inp" type="email" name="email" id="email" placeholder="xyz@gmail.com">
                <br>mot de passe :
                <input class="inp" type="password" name="pwd" id="pwd" placeholder="password">
            </div>
            <div class="form-element">
                <input type="checkbox" id="remember-me">
                SE SOUVENIR DE MOI
            </div>
            <div class="form-element">
                <button class="firstbtn">Connexion</button>
            </div>
        </div>
    </div>
    </form>
   
    
    <!--sign in -->
    <div class="popup" id="popup">
        <div class="close-btn" id="close-btn">&times;</div>
        <div class="form">
            <form action="t_inscription.php" method="post" enctype="multipart/form-data" >
            <h2  style="color:#3d5584">Sign in</h2>
            <div class="form-element" id="form-element">
                <div class="form1">
                    Nom : <br>
                <input  type="text" name="nom" id="nom" class="inp" placeholder="Nom">
                <br>Numéro de Télèphone : <br>
                <input  type="tel" name="tel" id="tel" class="inp" placeholder="0600000000">
                <br>Adresse : <br>
                <input  type="text" name="adresse" id="adresse" class="inp" placeholder="adresse">
                <br>Date de naissance : <br>
                <input  type="date" name="date_n" class="inp" id="birth">
                </div>
                <div class="form2">
                    <br>Email : <br>
                    <input class="inp" type="email" name="email2" id="email2" placeholder="xyz@gmail.com">
                <br>Mot de passe :
                <input type="password" name="pwd" class="inp" id="pwds" placeholder="password">
                <br>Conférmation de mot de passe :
                <input type="password" name="cpwd" class="inp" id="npwd" placeholder="password" onkeyup="checkPassword()">
                <div id="password-message" style="display: none; color: red;"></div>
                </div>
            
                
            </div>
            
        </div>
        <br>
        <input type="submit" value="Register" name="envoyer" class="firstbtn" >
    </form>
    <script>

    function checkPassword() {
        var password = document.getElementById("pwds").value;
        var confirmPassword = document.getElementById("npwd").value;
        var messageElement = document.getElementById("password-message");

        if (password === confirmPassword) {
            messageElement.style.display = "none";
        } else {
            messageElement.style.display = "block";
            messageElement.innerHTML = "Les mots de passe ne correspondent pas";
        }
    }

    document.getElementById("npwd").addEventListener("keyup", checkPassword);
</script>
   
    </div>

    <script>
          //login 
  document.querySelector("#show-login").addEventListener("click",function(){
    document.querySelector(".popup").classList.add("active");
   }) ;
   document.querySelector(".popup .close-btn").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
   }) ;
   //sign in 
   document.querySelector("#show-signin").addEventListener("click",function(){
    document.querySelector("#popup").classList.add("active");
   }) ;
   document.querySelector("#popup #close-btn").addEventListener("click",function(){
    document.querySelector("#popup").classList.remove("active");
   }) ;
   function toggle() {
    let mm = document.querySelector("#my_modal");
    mm.classList.toggle("open");}
    
    </script>
</body>
</html>