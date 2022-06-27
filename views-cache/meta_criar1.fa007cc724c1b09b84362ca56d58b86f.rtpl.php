<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main pb-0">


    <section class="section" >
    <!-- Início do Card -->
      <div class="card">
        <div class="card-body pb-0" style="max-height: 66vh;">
          
          <div class="col-md-8" style="position: absolute;">

            <div class="col-md-12">
              <h5 class="card-title mb-0" style="font-size: 4vh; color: #26A234;">Vamos criar uma meta!</h3>
              <p style="font-family: 'Overpass', sans-serif; font-size: 2.5vh;" class="text-muted">Para começar vamos escolher um nome pra sua meta e descidir o periodo de tempo que você terá para completa-la.</p>
            </div>
          <!-- Início do Fomrulário -->
            <div class="col-md-8 m-auto"> 
              <form action="/metas/guardando" method="post" class="row g-3 pt-1 d-flex justify-content-center">
                <!-- Box Nome -->
                <div class="col-md-12"> 
                  <label for="nome_meta" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="nome_meta" name="nome" required>
                </div>

                <!-- Box Objetivo -->
                <div class="col-md-9"> 
                  <label for="objetivo_meta" class="form-label">Objetivo</label>
                  <input type="text" class="form-control" id="objetivo_meta" name="objetivo" required>
                </div>

                <!--Box data inicial-->
                <div class="col-md-4">
                  <label for="data_inicial" class="form-label">Data inicial</label>
                  <input type="date" class="form-control" id="data_inicial" name="data_inicial" required>
                </div>

                <!--Box data final-->
                <div class="col-md-4">
                  <label for="data_final" class="form-label">Data final</label>
                  <input type="date" class="form-control" id="data_final" name="data_final" required>
                </div>

                <div class="text-center"> 
                  <a href="/metas"class="btn btn-sm btn-light">Voltar</a>
                  <button type="submit" class="btn btn-success" style="background-color:#26A234;font-weight: 650;">⠀Criar⠀</button> 
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-12 d-flex flex-row-reverse">
            <img src="../res/site/assets/img/guardando_background.png" alt="Guardando uma grana" style="max-height: 66vh;">
          </div>
        
        </div>
      </div>
    </section>

  </main><!-- End #main -->
