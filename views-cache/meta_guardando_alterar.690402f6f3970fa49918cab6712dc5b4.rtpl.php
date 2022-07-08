<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Guardando uma Grana</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="nova_meta.html">Cirar nova Meta</a></li>
            <li class="breadcrumb-item active">Guardando uma grana</li>
          </ol>
        </nav>
      </div>
    <!-- Fim Título da Pagina -->

    <section class="section" >
    <!-- Início do Card -->
      <div class="card m-3">
        <div class="card-body pb-0" style="max-height: 66vh;">
          
          <div class="col-md-6" style="position: absolute;">
          <!-- Início do Fomrulário -->
          <form action="/metas/alterar" method="post" class="row g-3 pt-5">

            <!-- Box Nome -->
            <div class="col-md-12"> 
              <label for="nome_meta" class="form-label">ID</label>
              <input type="text" class="form-control" id="id_meta" name="id_meta" value="<?php echo htmlspecialchars( $meta["id_meta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>

            <!-- Box Nome -->
            <div class="col-md-12"> 
              <label for="nome_meta" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome_meta" name="nome" value="<?php echo htmlspecialchars( $meta["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>

            <!-- Box Objetivo -->
            <div class="col-md-8"> 
              <label for="objetivo_meta" class="form-label">Objetivo</label>
              <input type="text" class="form-control" id="objetivo_meta" name="objetivo" value="<?php echo htmlspecialchars( $meta["objetivo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>

            <!-- Box Valor -->
            <div class="col-md-4"> 
              <label for="valor_meta" class="form-label">Valor</label>
              <input type="number" class="form-control" id="valor_meta" placeholder="R$" name="valor" value="<?php echo htmlspecialchars( $meta["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>

            <!--Box data inicial-->
            <div class="col-md-4">
              <label for="data_inicial" class="form-label">Data de início</label>
              <input type="date" class="form-control" id="data_inicial" name="data_inicial" value="<?php echo htmlspecialchars( $meta["data_inicial"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>

            <!--Box data final-->
            <div class="col-md-4">
              <label for="data_final" class="form-label">Data final</label>
              <input type="date" class="form-control" id="data_final" name="data_final" value="<?php echo htmlspecialchars( $meta["data_final"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>

            <div class="col-md-4"> 
              <label for="conta_meta" class="form-label">Conta</label> 
              <select id="conta_meta" class="form-select" name="id_conta" required>
              <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                <option <?php echo htmlspecialchars( $value1["id_conta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
              <?php } ?>
              </select>
            </div>
            
            <div class="col-md-12 d-flex justify-content-center pt-2 pb-3">
              <div class="form-check form-switch"> 
                <input class="form-check-input" name="valor_atual" type="checkbox" id="switch_saldo_atual"> 
                <label class="form-check-label" for="switch_saldo_atuals">Usar saldo atual da conta</label>
              </div>
            </div>

            <div class="text-center"> 
              <button type="reset"class="btn btn-sm btn-light">Limpar</button>
              <button type="submit" class="btn btn-success" style="background-color:#26A234;font-weight: 650;">Alterar</button> 
            </div>
          </form>
          </div>

          <div class="col-md-12 d-flex flex-row-reverse">
            <img src="../../res/site/assets/img/guardando.png" alt="Guardando uma grana" style="max-height: 66vh;">
          </div>
        
        </div>
      </div>
    </section>

  </main><!-- End #main -->
