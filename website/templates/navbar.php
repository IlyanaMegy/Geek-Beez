<style>
    .navbar {
        background: none;
    }
    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 1rem;
        padding-left: 1rem;
    }
    .logo_navbar{
        height:45px;
        width:45px;
        margin-right:7px;
    }
    .left-items{
        margin-top: 10px;
        font-size: small;
    }

    input{
        margin: 0;
        font-family: inherit;
        font-size: small;
        line-height: inherit;
        text-align: right;
        height: 30px;
        width: 180px;
        padding: 5px;
    }
</style>
<?php 
    session_start();
    include_once('bdd.php');
?>
<nav class="navbar navbar-expand-lg fixed-top" style="background: rgba(255, 255, 255);padding: 0;" id="mainNav">
    <div class="container px-4" style="direction:ltr;">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            
            <ul class="navbar-nav" style="display:flex;">
                <li class="nav-item"><a class="nav-link active " href="{{ path('accueil') }}"><img style="height:70px;width:70px;margin-right:10px;" src="images/logos/logo_geek_beez.svg" alt="geek beez icon"></a></li>
                <li class="nav-item"><a class="nav-link active left-items" href="{{ path('shop')}}"><img src="images/icons/shop_icon.svg" class="logo_navbar" alt="shop icon"></a><p style="font-size:x-small;margin-right: 7px;text-align:center;">Boutique</p></li>
                <li class="nav-item"><a class="nav-link active left-items" href="{{ path('parrainage')}}"><img src="images/icons/parrainage.svg" class="logo_navbar" alt="parrainage icon"></a><p style="font-size:x-small;margin-right: 7px;text-align:center;">Parrainage</p></li>
                <li class="nav-item"><a class="nav-link active left-items" href="{{ path('service')}}"><img src="images/icons/services.svg" class="logo_navbar" alt="services icon"></a><p style="font-size:x-small;margin-right: 7px;text-align:center;">Services</p></li>
            </ul>
        </div>
    </div>

    <div class="container" style="direction: rtl;">
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav" style="display:flex;">

                <!-- php ici si utilisateur connecté alors redirection vers page profil.php sinon redirection vers page index.php -->
                {% if panier %}
                    {% if genre == "0" %}
                        <li class="nav-item">
                            <a class="nav-link link_enable" href="{{ path('app_login')}}"><img class="logo_navbar" src="images/icons/profil_mec_v.svg"></a>
                            <p style="font-size:x-small;margin-right: 7px;text-align:center;">Profil</p>
                        </li>
                    {% endif %}
                    {% if genre == "1" %}
                        <li class="nav-item">
                            <a class="nav-link link_enable" href="{{ path('profil')}}"><img class="logo_navbar" src="images/icons/profil_fille_v.svg"></a>
                            <p style="font-size:x-small;margin-right: 7px;text-align:center;">Profil</p>
                        </li>
                    {% endif %}
                {% else %}
                    <li class="nav-item">
                        <a class="nav-link link_enable" href="{{ path('app_login')}}"><img class="logo_navbar" src="images/icons/profil_mec_x.svg"></a>
                        <p style="font-size:x-small;margin-right: 7px;text-align:center;">Profil</p>
                    </li>
                {% endif %}

                {% if panier %}
                    {% if (panier.occurrence != 0) %}
                            <li class="nav-item"><a class="nav-link active" href="{{ path('panier')}}"><img class="logo_navbar" src="images/icons/panier_full.svg"></a><p style="font-size:x-small;margin-right: 7px;text-align:center;">Panier</p></li> 
                    {% else %}
                            <li class="nav-item"><a class="nav-link active" href="{{ path('panier')}}"><img class="logo_navbar" src="images/icons/panier_vide.svg"></a><p style="font-size:x-small;margin-right: 7px;text-align:center;">Panier</p></li> 
                    {% endif %}
                {% else %}
                    <li class="nav-item"><a class="nav-link active" href="{{ path('app_login')}}"><img class="logo_navbar" src="images/icons/panier_vide.svg"></a><p style="font-size:x-small;margin-right: 7px;text-align:center;">Panier</p></li> 
                {% endif %}

                
                <div style="display: none;" id="search_bar">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                <label name="find_product" style="padding-top:10px;">
                    <a href="findreader.html"><img src="images/icons/search_icon.png" id="search_icon" style="margin: 1rem;height:25px;width:25px;" alt="seach icon"></a>
                    <input type="text" class="reader_pseudo" name="pseudo" placeholder="...recherchez un produit" required />
                </label>

            </ul>
        </div>
    </div>
</nav>