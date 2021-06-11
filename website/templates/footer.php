<style>

    .footer{
        padding:0;
        padding-bottom:2%;
        padding-top: 2%;
        margin-top: 10%;
        background-color: rgb(245, 253, 180);
    }

    .footer_text{
        letter-spacing:2px;
        color: black;
        text-align:center;
    }
    .footer_text:hover{
        text-decoration: none;
        color:rgb(68, 41, 15);
        outline:0;
    }

    .footer_li{
        list-style:none;
        text-align:center;
    }

    a{
        text-decoration: none;
    }
</style>


<div class="container-fluid footer">
    <div class="row" style="width:80%;margin-left:10%;">
        <div class="col-4" name="us_col" style="padding-left:3%;">
            <div style="margin-left:30%;margin-bottom:0%;">
                <img class='logo' style="height:135px;width:135px;" src="../logo/logo_lighter.png" alt="GeekBeez logo"/>
            </div>
            
            <p style="letter-spacing:2px;;text-align:center;font-size:medium;">
            Les apiculteurs amateurs.</p>
        </div> 

        <div class="col-4" name="pages_col" style="padding:0;border:1px solid #4d3c20;border-top:none;border-bottom:none;">
            <p style="letter-spacing:2px;text-align:center;margin-top:15%;font-size:20px;">Visitez nos pages</p>
            
            <ul style="padding-left:0;margin-bottom:5%;margin-top:8%;">
                <li class="footer_li">
                    <a href="#" class="footer_text" style="font-size:medium;">Accueil</a>
                </li>
                    
                <li class="footer_li">
                    <a href="#" class="footer_text" style="font-size:medium;">Boutique</a>
                </li>
                    
                <li class="footer_li">
                    <a href="#" class="footer_text" style="font-size:medium;">Parrainage</a>
                </li>

                <li class="footer_li">
                    <a href="#" class="footer_text" style="font-size:medium;">Services</a>
                </li>
                    
                <?php if (isset($_SESSION['IS_CONNECTED'])) {?>
                <li class="footer_li">
                    <a href="#" class="footer_text" style="font-size:medium;">Profil</a>
                </li>
                <?php }?>

                <?php if (isset($_SESSION['IS_CONNECTED'])) {?>
                <li class="footer_li">
                    <a href="#" class="footer_text" style="font-size:medium;">Panier</a>
                </li>
                <?php }?>
            </ul>
        </div>

        <div class="col-4" name="contact_col" style="padding-left:3%;">
            <p style="letter-spacing:2px;;text-align:center;margin-top:17%;font-size:20px;">Contact</p>
            
            <ul style="padding-left:0;margin-bottom:5%;margin-top:10%;">
                <li class="footer_li" style="margin:2%;text-align:left;">
                    <div class="row">
                        <div class="col-3">
                        <div style="padding-left:70%;">
                            <img style="height:25px;width:25px;" src="images/icons/phone.png" alt="telephone number"/>
                        </div>
                        </div>
                        <div class="col-9">
                        <a style="font-size:small;" class="footer_text" href="#"> (+33)06.12.34.56.78 </a>
                        </div>
                    </div>
                </li>

                <li class="footer_li" style="margin:3%;text-align:left;">
                    <div class="row">
                        <div class="col-3">
                        <div style="padding-left:70%;padding-top:2%;">
                            <img style="height:25px;width:25px;" src="images/icons/email.png" alt="email"/>
                        </div>
                        </div>
                        <div class="col-9">
                        <a style="font-size:small;" class="footer_text" href="mailto:geekbeez@outlook.fr"> geekbeez@outlook.fr </a>
                        </div>
                    </div>
                </li>

                <li class="footer_li" style="margin:2%;text-align:left;">
                    <div class="row">
                        <div class="col-3">
                        <div style="padding-left:70%;padding-top:5%;">
                            <img style="height:25px;width:25px;" src="images/icons/adresse.png" alt="address"/> 
                        </div>
                        </div>
                        <div class="col-9">
                        <a class="footer_text" style="font-size:small;" href="https://www.google.com/maps/place/Bordeaux+Ynov+Campus/@44.854186,-0.5684943,17z/data=!3m1!4b1!4m5!3m4!1s0xd55287c2b667971:0xfaa5a2368b146e35!8m2!3d44.854186!4d-0.5663056" target="_blank">
                            89 quai des Chartrons, 33300 Bordeaux.
                        </a>
                        </div>                        
                    </div>
                </li>
            </ul>
        </div> 
    </div>
</div>