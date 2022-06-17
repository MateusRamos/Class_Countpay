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
      <div class="card">
        <div class="card-body pb-0" style="max-height: 66vh;">
          
          <div class="col-md-8" style="position: absolute;">
          <!-- Início do Fomrulário -->
          <form action="/metas/guardando" method="post" class="row g-3 pt-5">
            <!-- Box Nome -->
            <div class="col-md-7"> 
              <label for="nome_meta" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome_meta" name="nome" required>
            </div>

            <!-- Box Objetivo -->
            <div class="col-md-5"> 
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

            <div class="col-md-5"> 
              <label for="conta_meta" class="form-label">Conta</label> 
              <select id="conta_meta" class="form-select" name="conta" required>
                <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                  <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>
              </select>
            </div>

            <!--Box Notificações
            <div class="col-md-5"> 
              <label for="notifica_meta" class="form-label">Notificações</label> 
              <select id="notifica_meta" class="form-select">
                <option></option>
                <option>Semanalmente</option>
                <option>Quinzenalmente</option>
                <option>Mensalmente</option>
                <option>Somente ao atingir a meta</option>
              </select>
            </div>-->

            <!--Box Botões-->
            <div class="text-center"> 
              <button type="reset"class="btn btn-sm btn-light">Limpar</button>
              <button type="submit" class="btn btn-success" style="background-color:#26A234;font-weight: 650;">⠀Criar⠀</button> 
            </div>
          </form>
          </div>

          <div class="col-md-12 d-flex flex-row-reverse">
            <img src="../res/site/assets/img/guardando_background.png" alt="Guardando uma grana" style="max-height: 66vh;">
          </div>
        
        </div>
      </div>
    </section>

  </main><!-- End #main -->
