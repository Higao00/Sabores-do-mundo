<?php
include 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
    img#perfil {
        margin-top: 10%;
    }

    div#menu {
        text-align: center;
    }

    a.list-group-item{
        text-align: left;
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
            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2810%29.jpg" id="perfil" class="rounded-circle" alt="woman avatar">
        </div>

        <!-- Content -->
        <div class="card-body">
            <!-- Name -->
            <h4 class="card-title">Anna Doe</h4>
            <hr>
            <div class="list-group" id="menu" >
                <a href="#!" class="list-group-item list-group-item-action active" contenteditable="true">
                    Cras justo odio
                </a>
                <a href="#!" class="list-group-item list-group-item-action" contenteditable="false">
                    <i class="fas fa-edit"></i>
                    Dapibus ac facilisis in</a>
                <a href="#!" class="list-group-item list-group-item-action" contenteditable="true">Morbi leo risus</a>
                <a href="#!" class="list-group-item list-group-item-action" contenteditable="true">Porta ac consectetur ac</a>
                <a href="#!" class="list-group-item list-group-item-action" contenteditable="true">Vestibulum at eros</a>
            </div>

        </div>

    </div>
    <!-- Card -->
</div>

<?php
include 'rodape.php';
?>

<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>
    $(document).ready(function() {
        $('i').click(function() {
            let aux;
            $(this).parents('a').attr('contenteditable') == "true" ? aux = 'false' : aux = 'true';
            $(this).parents('a').attr('contenteditable', aux);

            console.log(aux);
        });
    });
</script>