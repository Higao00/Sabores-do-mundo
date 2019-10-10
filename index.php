<?php
include 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
    img#offline {
        margin-top: 50px;
    }

    h5 {
        margin-top: 50px;
    }

    h6 {
        margin-top: 25px;
        margin-bottom: 30px;
    }

    button.btn {

        margin-bottom: 50px;

    }
</style>


<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container">
    <!-- Card -->
    <div class="card testimonial-card">

        <!-- Background color -->
        <div class="card-up indigo lighten-1"></div>

        <!-- Avatar -->
        <div class="avatar mx-auto white">
            <img src="img/icon.png" id="offline">
        </div>
        <div class="text-center">
            <h5><strong>Parece que não há internet!</strong></h2>
                <h6>Verifique a sua conexão para <br>continuar navegando.</h3>
                    <button type="button" class="btn btn-outline-deep-orange  waves-effect">Tentar Novamente</button>
        </div>
    </div>

    <?php
    include 'rodape.php';
    ?>

    <!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPRIOS SCRIPTS -->
    <script>


    	function verifica_net(){
    	    var online = navigator.onLine; // true ou false, (há, não há conexão à internet)
    	    if(online) {
    	        location.replace("home.php");
    	    }
    	}

        if ('serviceWorker' in navigator && 'PushManager' in window) {
          console.log('Service Worker and Push is supported');
          //mysw.js has the push method and payload, mysw.js also has the eventhandler fr when the notification is clicked
          navigator.serviceWorker.register('sw.js') //this MUST be in the same directory as index.php
          .then(function(swReg) {
            console.log('Service Worker is registered', swReg);

            swRegistration = swReg;
            initialiseUI();

          })
          .catch(function(error) {
            console.error('Service Worker Error', error);
          });
        }

        verifica_net();
    </script>

</div>
<!--Main layout-->