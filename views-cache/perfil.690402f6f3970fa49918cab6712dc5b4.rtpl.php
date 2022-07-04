<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Meu Perfil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">Meu perfil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../res/site/assets/img/perfil.png" alt="Profile" class="rounded-circle">
              <h2><?php echo htmlspecialchars( $dados["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $dados["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
              <h3><?php echo htmlspecialchars( $dados["ocupacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
              </h3>
              <div class="social-links mt-2">
                <a href="<?php echo htmlspecialchars( $dados["twitter"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="<?php echo htmlspecialchars( $dados["facebook"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?php echo htmlspecialchars( $dados["instagram"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="<?php echo htmlspecialchars( $dados["linkedin"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detalhes</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Sobre mim</h5>
                  <p class="small fst-italic"><?php echo htmlspecialchars( $dados["sobre_mim"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>

                  <h5 class="card-title">Detalhes do Perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nome Completo</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $dados["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Ocupação</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["ocupacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">País</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cidade</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Endereço</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefone</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars( $dados["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="/perfil" method="post">

                    <div class="row mb-3">
                      <label for="usuario_nome" class="col-md-4 col-lg-3 col-form-label">Nome</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nome" type="text" class="form-control" id="usuario_nome" value="<?php echo htmlspecialchars( $dados["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_sobrenome" class="col-md-4 col-lg-3 col-form-label">Sobrenome</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="sobrenome" type="text" class="form-control" id="usuario_sobrenome" value="<?php echo htmlspecialchars( $dados["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_sobre_mim" class="col-md-4 col-lg-3 col-form-label">Sobre mim</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="sobre_mim" class="form-control" id="usuario_sobre_mim" style="height: 100px"></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_ocupacao" class="col-md-4 col-lg-3 col-form-label">Ocupação</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ocupacao" type="text" class="form-control" id="usuario_ocupacao" value="<?php echo htmlspecialchars( $dados["ocupacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_pais" class="col-md-4 col-lg-3 col-form-label">País</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pais" type="text" class="form-control" id="usuario_pais" value="<?php echo htmlspecialchars( $dados["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="usuario_cidade" class="col-md-4 col-lg-3 col-form-label">Cidade</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="cidade" type="text" class="form-control" id="usuario_cidade" value="<?php echo htmlspecialchars( $dados["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_endereco" class="col-md-4 col-lg-3 col-form-label">Endereço</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="endereco" type="text" class="form-control" id="usuario_endereco" value="<?php echo htmlspecialchars( $dados["endereco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="telefone" class="col-md-4 col-lg-3 col-form-label">Telefone</label>
                      <div class="col-md-8 col-lg-9">

                        <input name="telefone" type="text" class="form-control" id="telefone">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="usuario_email" value="<?php echo htmlspecialchars( $dados["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_twitter" class="col-md-4 col-lg-3 col-form-label">Twitter</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="usuario_twitter" value="<?php echo htmlspecialchars( $dados["twitter"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_facebook" class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="usuario_facebook" value="<?php echo htmlspecialchars( $dados["facebook"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_instagram" class="col-md-4 col-lg-3 col-form-label">Instagram</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="usuario_instagram" value="<?php echo htmlspecialchars( $dados["instagram"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="usuario_linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="usuario_linkedin" value="<?php echo htmlspecialchars( $dados["linkedin"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-success">Salvar Mudanças</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
