<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Receita Única ou Fixa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="lancamento_receita.html">Nova Receita</a></li>
          <li class="breadcrumb-item active">Receita Única ou Fixa</li>
        </ol>
      </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section" >
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="card" style="min-height: 66vh;">
                    <div class="card-body d-flex align-items-center">
                      <div class="col-md-7">
                        <form action="/lancamento/receita/unica" method="post" class="row g-4 pt-4 pb-4 d-flex justify-content-center">

                            <div class="col-md-10">
                                <label for="descricao_receita" class="form-label">Descrição</label>
                                <input type="text" name="descricao" class="form-control" id="descricao_receita" required>
                            </div>

                            <div class="col-md-3">
                                <label for="valor_receita" class="form-label">Valor</label>
                                <input type="number" name="valor" placeholder="R$ 00,00"  class="form-control" id="valor_receita">
                            </div>

                            <div class="col-md-4">
                              <label for="contacartao_receita" class="form-label">Tipo Receita</label>
                               <select class="form-select" name="tipo_receita" id="contacartao_receita">
                                  <option>Receita</option>
                                  <option>Receita Fixa</option>
                              </select>
                            </div>

                            <div class="col-md-3">
                                <label for="data_receita" class="form-label">Data da Receita</label>
                                <input type="date" name="data_receita" class="form-control" id="data_receita" required>
                            </div>

                            
                            <div class="col-md-5">
                              <label for="conta_usuario" class="form-label">Conta</label>
                              <select class="form-select" name="id_conta" id="conta_usuario">
                                <option value="">Opção conta não utilizada</option>
                                  <?php $counter1=-1;  if( isset($dados["conta"]) && ( is_array($dados["conta"]) || $dados["conta"] instanceof Traversable ) && sizeof($dados["conta"]) ) foreach( $dados["conta"] as $key1 => $value1 ){ $counter1++; ?>
                                  <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                  <?php } ?>
                              </select>
                          </div>


                          <div class="col-md-5">
                            <label for="cartao_usuario" class="form-label">Cartão</label>
                            <select class="form-select" name="id_cartao" id="cartao_usuario">
                              <option value="">Opção cartão não utilizada</option>
                              <?php $counter1=-1;  if( isset($dados["cartao"]) && ( is_array($dados["cartao"]) || $dados["cartao"] instanceof Traversable ) && sizeof($dados["cartao"]) ) foreach( $dados["cartao"] as $key1 => $value1 ){ $counter1++; ?>
                              <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                              <?php } ?>
                            </select>
                        </div>


                            <div class="col-md-10 mb-3">
                                <label for="categoria_receita" class="form-label">Categoria</label>
                                <select class="form-select" name="id_categoria" id="contacartao_receita" required>
                                  <?php $counter1=-1;  if( isset($dados["categoria"]) && ( is_array($dados["categoria"]) || $dados["categoria"] instanceof Traversable ) && sizeof($dados["categoria"]) ) foreach( $dados["categoria"] as $key1 => $value1 ){ $counter1++; ?>
                                  <option><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                  <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-9 d-flex justify-content-center">
                              <button type="button" class="btn btn-secondary me-1">Cancelar</button>
                              <button type="submit" class="btn btn-success" style="background-color: #26A234; border-color: #26A234;">Salvar Receita</button>
                            </div>
                        </form>
                      </div>
                        <div class="col-md-5">
                          <img src="../../res/site/assets/img/img_receita_unica.png" alt="Receita Única" style="max-height: 66vh;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->