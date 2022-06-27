<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Criar Nova Meta</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active">Criar Nova Meta</li>
          </ol>
        </nav>
      </div>
    <!-- Fim Título da Pagina -->

    <section class="section" >
    <!-- Início do Card -->
      <div class="card">
        <div class="card-body pb-0" style="max-height: 66vh;">
          
          <div class="col-md-7" style="position: absolute;">
          <!-- Início do Fomrulário -->
          <form action="/metas/criar" method="post" class="row g-3 pt-5 d-flex justify-content-center">
            <!-- Box Nome -->
            <div class="col-md-10"> 
              <label for="nome_meta" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome_meta" name="nome" required>
            </div>

            <!-- Box Objetivo -->
            <div class="col-md-6"> 
              <label for="objetivo_meta" class="form-label">Objetivo</label>
              <input type="text" class="form-control" id="objetivo_meta" name="objetivo" required>
            </div>

            <!-- Box Valor -->
            <div class="col-md-4"> 
              <label for="valor_meta" class="form-label">Valor</label>
              <input type="number" class="form-control" id="valor_meta" placeholder="R$" name="valor" required>
            </div>

            <!--Box data inicial-->
            <div class="col-md-3">
              <label for="data_inicial" class="form-label">Data de início</label>
              <input type="date" class="form-control" id="data_inicial" name="data_inicial" required>
            </div>

            <!--Box data final-->
            <div class="col-md-3">
              <label for="data_final" class="form-label">Data final</label>
              <input type="date" class="form-control" id="data_final" name="data_final" required>
            </div>

            <div class="col-md-4"> 
              <label for="conta_meta" class="form-label">Conta</label> 
              <select id="conta_meta" class="form-select" name="id_conta" required>
                <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                  <option value="<?php echo htmlspecialchars( $value1["id_conta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
            </div>



            <div class="col-md-12 pt-4 d-flex justify-content-center">
              <div class="form-check form-switch"> 
                <input class="form-check-input" name="valor_atual" type="checkbox" id="switch_saldo_atual"> 
                <label class="form-check-label" for="switch_saldo_atuals">Usar saldo atual da conta?</label>
              </div>
            </div>
            <div class="text-center pt-3"> 
              <button type="reset"class="btn btn-sm btn-light">Limpar</button>
              <button type="submit" class="btn btn-success" style="background-color:#26A234;font-weight: 650;">⠀Criar⠀</button> 
            </div>
          </form>
          </div>

          <div class="col-md-12 d-flex flex-row-reverse">
            <img src="../res/site/assets/img/guardando.png" alt="Guardando uma grana" style="max-height: 66vh;">
          </div>
        
        </div>
      </div>
    </section>

  </main><!-- End #main -->
