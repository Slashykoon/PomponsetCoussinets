<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Contact - Pet Sitting à Nancy</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Content-Language" content="fr">
    <meta name="Description" content="Garde Pet sitting à Nancy">
    <meta name="Keywords" content="Garde Pet sitting à Nancy">
    <meta name="Subject" content="Pet sitting">
    <meta name="Copyright" content="Celine Levrechon">
    <meta name="Author" content="Celine Levrechon">
    <meta name="Publisher" content="Celine Levrechon">
    <meta name="Geography" content="Nancy, France,54000">
    <meta name="Category" content="animals">

    <meta property="og:title" content="Contact -  Pet Sitting à Nancy">
    <meta property="og:type" content="website">
    <meta property="og:updated_time" content="2022-10-01 10:21:17">
    <meta property="og:url" content="https://pomponsetcoussinets.fr/contact.php">
    <meta name="robots" content="follow,index">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/style.css" rel="stylesheet">
    <!-- Librairie JQuery pour requete AJAX-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b0f7e6ecb6.js" crossorigin="anonymous"></script>
    <!-- SB Forms JS -->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <!-- Leaflet JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
</head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-HQ8EHLCJB9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-HQ8EHLCJB9');
</script>

<!-- Header -->
<?php include('header.php') ?>

<!-- Body -->
<body style="background-color:#FDF8F5">

    <div class="global-page shadow-color-green">
        <div class="grand-titre">
            <h1 class="text-colorization">Zone d'intervention</h1>
            <!--<div class="grand-titre-left"></div>
            <div class="grand-titre-right"></div>-->
        </div>

        <img class="img-decoration-dog2" src="img/dog2.svg" alt="Pet sitting à Nancy">
        <img class="img-decoration-cat4" src="img/Kitten-Silhouette-2.svg" alt="Dog sitter à Nancy">


        <p>Des frais additionnels sont appliqués lors de déplacement hors de mon rayon d'action (en bleu)</p>

        <div id="map" style=" height:500px;"></div>



        <div class="grand-titre">
            <h1 class="text-colorization">Me contacter</h1>
            <!--<div class="grand-titre-left"></div>
            <div class="grand-titre-right"></div>-->
        </div>

            <p><i class="fas fa-phone-alt fa-lg"></i> Téléphone : 06 38 64 77 90 </p>
            <p><i class="fas fa-calendar-alt fa-lg"></i> Horaires : du lundi au vendredi de 9h30 à 19h30 et le samedi de 14h à 18h30.</p><br/>
            
            <div class="form_section">

                <!-- Formulaire de contacte-->
                <form id="contact-form" class="form_section_layout" name="contact-form" action="mail.php" method="POST" onsubmit="return false"
                            data-sb-form-api-token="API_TOKEN">

                <!-- Nom -->
                <div class="form_item">
                    <label class="form-label" for="name">Nom</label>
                    <input class="form-control shadow" id="name" name="name" type="text" placeholder="Nom"
                        data-sb-validations="required" />
                    <div class="invalid-feedback" data-sb-feedback="name:required">Nom requis.</div>
                </div>

                <!-- Email -->
                <div class="form_item">
                    <label class="form-label" for="emailAddress">Adresse Email</label>
                    <input class="form-control shadow rounded" id="emailAddress" name="emailAddress" type="email"
                        placeholder="Adresse Email" data-sb-validations="required, email" />
                    <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Adresse mail requis.</div>
                    <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Adresse mail non valide.
                    </div>
                </div>

                <!-- Message -->
                <div class="form_item">
                    <label class="form-label" for="message">Message</label>
                    <textarea class="form-control shadow " id="message" name="message" type="text"
                        placeholder="Bonjour , je voudrais prendre rendez-vous pour la garde de mon animal de compagnie ... "
                        style="height: 10rem;" data-sb-validations="required"></textarea>
                    <div class="invalid-feedback" data-sb-feedback="message:required">Veuillez entrer un message.</div>
                </div>

                <!-- Retour de status echange mail AJAX -->
                <div class="status text-center h3" id="status"></div>

                <!-- Bouton submit -->
                <div class="form_item">
                    <button class="button-styler" style="background-color: #125948;opacity:0.9;" type="submit"
                        onclick="validateForm()">Envoyer</button>
                </div>
                </form>
            </div>
        </div>
     </div>


</body>

<!-- footer -->
<?php include('footer.php') ?>


<!--scripts customisés-->
<script>
function validateForm() {
    document.getElementById('status').innerHTML = "Envoi en cours...";

    formData = {
        'name': $('input[name=name]').val(),
        'email': $('input[name=emailAddress]').val(),
        'message': $('textarea[name=message]').val()
    };

    $.ajax({
        type: "POST",
        url: "send_mail.php",
        dataType: 'json',
        data: formData,
        success: function(data, textStatus, jqXHR) {

            $('#status').text(data.message);
            if (data.code) //Si mail envoyé alors reset
                $('#contact-form').closest('form').find("input[type=text], textarea").val("");
                //$('#SuccessMessage').removeClass("d-none");;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#status').text(jqXHR);
        }
    });
}


var map = L.map('map').setView([48.7386, 6.00135], 11.5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);

var marker = L.marker([48.7386, 6.00135]).addTo(map);

var polygon = L.polygon([
    [48.690605, 5.958943],
    [48.740371, 5.972008],
    [48.778062, 6.049156],
    [48.780127,	6.132716],
    [48.752648,	6.140308],
    [48.69191,	6.037901],

]).addTo(map);

    /*polygon.setStyle({fillOpacity: 0.5});*/

var CircleMax= L.circle([48.7386, 6.00135], 17000).addTo(map);
CircleMax.setStyle({fillColor: '#0000FF'});
CircleMax.setStyle({color: 'red'});
CircleMax.setStyle({fillOpacity: 0.1});

polygon.bindPopup("<b>Zone d'intervention approximative<br/>(sans frais de déplacement)</b>").openPopup();
/*polygon2.bindPopup("<b>Ceci est mon rayon d'action approximatif</b>").openPopup();*/

map.scrollWheelZoom.disable();

</script>

</html>