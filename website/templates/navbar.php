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
</style>
<script>
    function show_search_bar() {
        var x = document.getElementById("search_bar");
        if (x.style.display === "none") {
            x.style.display = "block";
            document.getElementById("search_icon").style.display = "none";
        } else {
            x.style.display = "none";
        }
    } 
</script>
<?php 
    session_start();
    include_once('bdd.php');
?>
<nav class="navbar navbar-expand-lg fixed-top" style="background: rgba(255, 255, 255);padding: 0;" id="mainNav">
    <div class="container px-4" style="direction:ltr;">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            
            <ul class="navbar-nav" style="display:flex;">
                <li class="nav-item"><a class="nav-link disabled" aria-current="page" aria-disabled="true" href="{{ path('accueil') }}"><img style="height:70px;width:70px;margin-right:10px;" src="images/logos/logo_geek_beez.svg" alt="geezk beez icon"></a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ path('produits')}}"><img src="images/icons/shop_icon.svg" class="logo_navbar" alt="shop icon"></a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ path('parrainage')}}">Parrainage</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ path('service')}}">Services</a></li>
            </ul>
        </div>
    </div>

    <div class="container" style="direction: rtl;">
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav" style="display:flex; margin-right:5%">

                <!-- php ici si utilisateur connecté alors redirection vers page profil.php sinon redirection vers page index.php -->
                {% if panier %}
                    <li class="nav-item">
                        <a class="nav-link link_enable" href="{{ path('profil')}}">profil</a>
                    </li> 
                {% else %}
                    <li class="nav-item">
                        <a class="nav-link link_enable" href="{{ path('app_login')}}">profil</a>
                    </li>
                {% endif %}

                {% if panier %}
                    {% if (panier.occurrence != 0) %}
                            <li class="nav-item"><a class="nav-link active" href="{{ path('panier')}}"><img class="logo_navbar" src="images/icons/panier_full.svg"></a></li> 
                    {% else %}
                            <li class="nav-item"><a class="nav-link active" href="{{ path('panier')}}"><img class="logo_navbar" src="images/icons/panier_vide.svg"></a></li> 
                    {% endif %}
                {% else %}
                    <li class="nav-item"><a class="nav-link active" href="{{ path('app_login')}}"><img class="logo_navbar" src="images/icons/panier_vide.svg"></a></li> 
                {% endif %}

                <img onclick="show_search_bar()" src="images/icons/search_icon.png" id="search_icon" style="height:25px;width:25px;margin-top:10px" alt="seach icon"></button>
                <div style="display: none;" id="search_bar">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </ul>
        </div>
    </div>
</nav>