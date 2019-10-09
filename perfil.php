<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

include 'src/conexao.php';
include 'src/Usuario.php';

if(isset($_SESSION['id_user'])){
    $logado = 1; 
}else{
    session_start();

    if(isset($_SESSION['id_user'])){
        $user = new Usuario();

        $user->selectUserId($_SESSION['id_user']);
    }else{
        header('Location: index.php');
        die();
    }
}
?>

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

    a.list-group-item {
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
            <img src="img/perfil-sem-foto.png" id="perfil" class="rounded-circle" alt="woman avatar">
        </div>

        <!-- Content -->
        <div class="card-body">
            <!-- Name -->
            <h4 class="card-title"><?php echo utf8_encode($user->getNome()); ?></h4>
            <hr>
            <!-- Card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    <!-- Material form register -->
                    <form method="POST" action="control/usuario.php">
                        <input type="text" name="id_user" value="<?php echo ($user->getId()); ?>" style="display: none;">
                        <p class="h4 text-center py-4">Meu Perfil</p>

                        <!-- Material input text -->
                        <div class="md-form">
                            <i class="fa fa-user prefix grey-text"></i>
                            <input type="text" id="nome" required name="nome" class="form-control" value="<?php echo utf8_encode($user->getNome()); ?>">
                            <label for="nome" class="font-weight-light">Seu Nome</label>
                        </div>

                        <!-- Material input text -->
                        <div class="md-form">
                            <i class="fa fa-user prefix grey-text"></i>
                            <input type="date" id="data-nascimento" required name="data-nascimento" class="form-control" value="<?php echo $user->getNascimento(); ?>">
                        </div>

                        <!-- Material input email -->
                        <div class="md-form">
                            <i class="fa fa-envelope prefix grey-text"></i>
                            <input type="email" id="email" required name="email" class="form-control" value="<?php echo $user->getEmail(); ?>">
                            <label for="email" class="font-weight-light">Seu email</label>
                        </div>

                        <!-- Material input password -->
                        <div class="md-form">
                            <i class="fa fa-lock prefix grey-text"></i>
                            <input type="password" id="senha" name="senha" class="form-control" value=""> 
                            <label for="senha" class="font-weight-light">Sua senha</label>
                        </div>

                        <div class="text-center py-4 mt-3">;
                            <button class="btn btn-cyan deep-orange darken-1" name="update-usuario" type="submit">Registrar</button>
                        </div>
                    </form>
                    <!-- Material form register -->

                </div>
                <!-- Card -->
            </div>

        </div>

        <!-- Card -->
    </div>

    <?php
    include 'rodape.php';
    ?>

    <!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
    <script>

    </script>

</div>
<!--Main layout-->