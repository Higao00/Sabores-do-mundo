<?php
include 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
  .pt-3-half {
    padding-top: 1.4rem;
  }

  #arquivo {
    background-color: #d6d6d6;
    height: 200px;
    width: 100%;
  }

  #icon_mais {
    margin-top: 5%;
    margin-left: 45%;
  }

  .fa,
  .fas {
    margin-top: 17px;
  }

  #cadastro {
    float: right;
  }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<!-- Card -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="card-body ">
        <div class="card">
          <form class="text-center border border-light p-5" action="#!">
            <input type="text" id="exampleForm2" class="form-control" placeholder="Nome da Receita">
            <div class="card-body">
              <div id="table" class="table-editable" style="overflow:scroll;height:400px;width:100%;overflow:auto">
                <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
                <table class="table table-bordered table-responsive-md table-striped text-center" id="table">
                  <thead>
                    <tr>
                      <th class="text-center">Ingrediente</th>
                      <th class="text-center">Quantidade</th>
                      <th class="text-center">Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="hidden" id="hidden">
                      <td class="pt-3-half" contenteditable="true"></td>
                      <td class="pt-3-half" contenteditable="true"></td>
                      <td>
                        <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="form-group">
                  <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Modo de preparo"></textarea>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-outline-success waves-effect" id="cadastro">Cadastrar</button>
          </form>
          <!-- Editable table -->
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include 'rodape.php';
?>
<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>
  $(document).ready(function() {


    const $tableID = $('#table');

    const newTr = $('tbody > tr#hidden').removeClass('hidden');

    $('.table-add').on('click', 'i', () => {

      const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

      if ($tableID.find('tbody tr').length === 0) {

        $('tbody').append(newTr);
      }

      $tableID.find('table').append($clone);
    });

    $tableID.on('click', '.table-remove', function() {
      $(this).parents('tr').detach();
    });

  });
</script>

<?php
include 'rodape.php';
?>