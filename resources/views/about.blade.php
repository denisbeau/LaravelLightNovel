@extends('layouts.app')

@section('title', __('À propos'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>À propos</h1>
            <p class="lead mt-4">
                Raffi Boyajian - Denis-Lucian Miclea - Natali Paloyan
            </p>
            <hr />
            <p class="mt-4">
                420-5H6 MO Applications Web transactionnelles - Automne 2025, Collège Montmorency.
            </p>
            <hr />
            <p class="mt-4">Bouton accueil et Bibliothèque Light Novels:</p>
            <ul>
                <li><p class="mt-4">Envoie vers la page d'accueil (/light_novels)</p></li>
                <li><p class="mt-4">Dans app.blade.php Accueil renvoie vers /light_novels (.index) et Bibliothèque Light Novels renvoie vers / qui redirige vers /light_novels</p></li>
            </ul>
            <p class="mt-4">Bouton ajouter:</p>
            <ul>
                <li><p class="mt-4">Envoie vers la page d'ajout d'un light novel (/light_novels/create)</p></li>
                <li><p class="mt-4">Dans app.blade.php Ajouter renvoie vers /light_novels/create (.create)</p></li>
            </ul>
            <p class="mt-4">Bouton à propos:</p>
            <ul>
                <li><p class="mt-4">Envoie vers la page à propos (/about)</p></li>
                <li><p class="mt-4">Dans app.blade.php À propos renvoie vers /about avec un url</p></li>
            </ul>
            <p class="mt-4">Système d'authentification:</p>
            <ul>
                <li><p class="mt-4">Permet aux utilisateurs de se connecter, s'inscrire et se déconnecter</p></li>
                <li><p class="mt-4">Si l'utilisateur n'est pas connecté, il peut aller vers la page de connexion et inscription (avec les routes login et register)
                    s'il est connecté, son nom s'affiche avec un bouton de déconnexion (avec le route logout)</p></li>
                </p></li>
                <li><p class="mt-4">Si l'utilisateur est connecté, mais pas vérifié, il ne peut pas aller vers /home à cause du middleware verified</p></li>
                <li><p class="mt-4">Un problème potentiel est que les utilisateurs non vérifiés peuvent accéder à des pages sans vérifier leur adresse e-mail</p></li>
                <li><p class="mt-4">Les routes email permettent et les options MAIL dans .env permettent d'envoyer des e-mails de vérification à mailtrap et de changer la
                    date de vérification dans la base de données</p></li>
                </p></li>
            </ul>
            <p class="mt-4">Barre de recherche:</p>
            <ul>
                <li><p class="mt-4">Permet de rechercher un light novel par son titre ou son auteur</p></li>
                <li><p class="mt-4">On utilise input pour faire une bar de recherche avec id="lightnovel-search" dans app.blade.php</p></li>
            </ul>
            <p class="mt-4">Page liste des light novels:</p>
            <ul>
                <li><p class="mt-4">Montre toutes les light novels avec son id, titre, auteur, statut, chapitres,
                     contenu et photo et laisse la possibilité de les gérer (voir, modifier, supprimer)</p></li>
                <li><p class="mt-4">On peut montrer ceci à l'aide de index.blade.php
                     (on fait un foreach pour chaque light novel et on utilise .show .edit et .destroy pour les actions)</p></li>
            </ul>
            <p class="mt-4">Page ajout d'un light novel:</p>
            <ul>
                <li><p class="mt-4">Permet d'ajouter un light novel avec son titre, auteur, statut, chapitres,
                     contenu et photo</p></li>
                <li><p class="mt-4">On utilise create.blade.php avec un form qui envoie les données à .store</p></li>
            </ul>
            <hr />
            <p class="mt-4">Diagramme:</p>
            <img src="http://localhost/LaravelLightNovel/public/images/diagramme.png" alt="Diagramme" style="max-width:100%; height:auto;" />
            <hr />
            <p class="mt-4">Sites de référence:</p>
            <ul>
                <li><a href="https://www.webnovel.com/fr" target="_blank" rel="noopener">Webnovel</a></li>
                <li><a href="https://wtr-lab.com/en" target="_blank" rel="noopener">Wtr-lab</a></li>
                <li><a href="https://www.scribblehub.com/" target="_blank" rel="noopener">Scribble Hub</a></li>
                <li><a href="https://www.royalroad.com/" target="_blank" rel="noopener">Royal Road</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
