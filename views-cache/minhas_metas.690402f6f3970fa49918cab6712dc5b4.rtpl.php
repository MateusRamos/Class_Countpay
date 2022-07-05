<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Minhas Metas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Metas</li>
                <li class="breadcrumb-item active">Minhas Metas</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body" style="min-height: 66vh;">

                        <!-- Table with hoverable rows -->
                        <div class="card-body pt-3">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Título</th>
                                        <th scope="col">Objetivo</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($metas) && ( is_array($metas) || $metas instanceof Traversable ) && sizeof($metas) ) foreach( $metas as $key1 => $value1 ){ $counter1++; ?>
                                    <tr class="clickable" onclick="window.location='/metas/<?php echo htmlspecialchars( $value1["id_meta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>'">
                                        <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["objetivo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td  class="text-capitalize" ><?php echo htmlspecialchars( $value1["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td style="width:25vh">
                                            <a href="#" class="btn btn-success" style="line-height: 0.5;background-color: #26A234;"><i class="bx bx-play-circle"></i></a>
                                            <a href="#" class="btn btn-info text-light" style="line-height: 0.5;background-color: #0AA8D0;"><i class="bx bx-pause-circle"></i></a>
                                            <a href="/meta/<?php echo htmlspecialchars( $value1["id_meta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return ConfirmDelete()" class="btn btn-danger" style="line-height: 0.5; background-color: #E54640;"><i class="bx bxs-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="text-center pt-3">
                                <a href="/" type="button" class="btn btn-secondary me-1">Voltar</a>
                                <a href="/metas/criar" type="button" class="btn btn-info text-light" style="background-color: #0AA8D0;">Cria Nova Meta</a>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- End Table with hoverable rows -->

            </div>
        </div>

        </div>

        </div>


        </div>
    </section>

</main><!-- End #main -->

<script>
    function ConfirmDelete() {
      var result = prompt("Digite 'deletar' para confirmar exclusão");
  
      if (result == "deletar") {
       return true;
      } else {
       return false;
      }
    }
  </script>