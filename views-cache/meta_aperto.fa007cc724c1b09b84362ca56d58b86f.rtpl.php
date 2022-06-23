<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Saindo do Aperto</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="nova_meta.html">Cirar nova Meta</a></li>
            <li class="breadcrumb-item active">Saindo do Aperto</li>
          </ol>
        </nav>
      </div>
    <!-- Fim Título da Pagina -->

    <section class="section" >
    <!-- Início do Card -->
      <div class="card"  style="max-height: 68vh;">
        <div class="card-body pb-0">
          
          <div class="col-md-6 m-5" style="position: absolute;">
          <!-- Início do Fomrulário -->
          <form class="row g-3 pt-5">
          <!-- Box Nome -->
            <div class="col-md-10"> 
                <label for="nome_meta" class="form-label">Nome</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="nome_meta">
                </div>
            </div>

            <!-- Box Objetivo -->
            <div class="col-md-10"> 
              <label for="objetivo_meta" class="form-label">Objetivo</label>
              <input type="text" class="form-control" id="objetivo_meta">
            </div>
            
            <!-- Box Valor -->
            <div class="col-md-4"> 
              <label for="valor_meta" class="form-label">Porcentagem</label>
              <input type="number" class="form-control" id="valor_meta" placeholder="00%" title="Porcentagem da diminuição dos gastos mensais">
            </div>

            <!--Box Categoria-->
            <div class="col-md-6">
              <label for="select_categoria" class="form-label">Categoria</label>
              <div class="input-group mb-3">
                <select id="select_categoria" class="form-select">
                  <option value="">Não selecionar Categoria</option>
                  <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
                    <option value="<?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


            <!--Box Botões-->
            <div class="text-center "> 
              <button type="reset"class="btn btn-sm btn-light">Limpar</button>
              <button type="submit" class="btn btn-danger" style="background-color:#E54640;font-weight: 650;">⠀Criar⠀</button> 
            </div>
          </form>
          </div>

          <div class="col-md-12 d-flex flex-row-reverse">
            <img src="../res/site/assets/img/aperto_background.png" alt="Saindo do Aperto" style="max-height: 68vh;">
          </div>
        
        </div>
      </div>
    </section>

  </main><!-- End #main -->
