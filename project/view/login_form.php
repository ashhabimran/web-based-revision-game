<?php include('header.php');

        if(!isset($userErr)){
                $userErr="";
        }
        if(!isset($passwordErr)){
                $passwordErr="";
        }
        if(!isset($confirmErr)){
                $confirmErr="";
        }

        if(!isset($log)){
                $path = "../login.php";
                $rePath = "register_form.php";
        }else{
                $path = "#";
                $rePath = "view/register_form.php";
}
?>
<section class="ftco-section">
        
        <style>
        body{
        background-image: url(http://localhost/www/first_group_project/view/sprites/loginback1.png);
        background-repeat: no-repeat;
        background-size: cover;
        }
        </style>

        <div class="container">
                <h1>Log  In </h1>
                <form action="<?php echo $path?>" method="post">
                        <div class="inputWrapper">
                                <input class="input_field"  placeholder="Username" type="text" name="UN" autocomplete="off" id="input-1" required>
                                <label class="input_label" for="input-1">Username</label>
                                <span class="error"><?php echo($userErr);?></span>

                                <br><br>
                                <input class="input_field2" placeholder="Password" type="password" name="PW" autocomplete="off" id="input-2" required>
                                <label class="input_label2" for="input-2">Password</label>
                                <br><br>
                                <span class="error"><?php echo($passwordErr);?></span>
                        </div>

                        <br><br>
                        <button class="subbutton" type="submit" name="action" value="Login">Login</button>

                        <br><br>
                        <a href="<?php echo $rePath; ?>" >New user? Register first!</a>
                </form>
        </div>
</section>


<?php include('footer.php')?>