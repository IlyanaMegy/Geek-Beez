<?php 
 include_once('bdd.php');

    $query1 = $pdo->prepare('CREATE TABLE IF NOT EXISTS geekbeez.root (
        id_root int not null auto_increment,
        pseudo varchar(255) not null,
        roles json,
        email varchar(255) not null,
        password varchar(255) not null,
        PRIMARY KEY (id_root));');
    $query1->execute();

    $query2 = $pdo->prepare('CREATE TABLE IF NOT EXISTS geekbeez.user (
        id_user int not null auto_increment,
        pseudo varchar(255) not null,
        roles json,
        email varchar(255) not null,
        password varchar(255) not null,
        pays varchar(255) not null,
        sexe varchar(255) not null,
        photo varchar(255) null,
        adresse varchar(255) null,
        phone varchar(255) null,
        nom varchar(255) null,
        prenom varchar(255) null,
        isVerified boolean,
        PRIMARY KEY (id_user));');
    $query2->execute();

    $query3 = $pdo->prepare('CREATE TABLE IF NOT EXISTS geekbeez.produits (
        id_produit int not null auto_increment,
        photo varchar(255) not null,
        titre varchar(255) not null,
        genre varchar(255) not null,
        descr text(1000) not null,
        created_At DATE not null,
        prix int not null,
        PRIMARY KEY (id_produit));');
    $query3->execute();

    $query4 = $pdo->prepare('CREATE TABLE IF NOT EXISTS geekbeez.panier_perso (
        id_panier int not null auto_increment,
        id_produit int not null,
        id_user int not null,
        occurrence int not null,
        PRIMARY KEY (id_panier),
        FOREIGN KEY (id_produit) 
        REFERENCES user(id_user),
        FOREIGN KEY (id_user) 
        REFERENCES produits(id_produit));');
    $query4->execute();

    // $query5 = $pdo->prepare('CREATE TABLE IF NOT EXISTS geekbeez.billet (
    //     id_com int not null auto_increment,
    //     titre_com varchar(255) not null,
    //     contenu varchar(255) not null,
    //     date_creation DATE not null,
    //     pseudo_user varchar(255) not null,
    //     PRIMARY KEY (id_com));');
    // $query5->execute();