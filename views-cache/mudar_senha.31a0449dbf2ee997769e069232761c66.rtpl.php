<?php if(!class_exists('Rain\Tpl')){exit;}?><main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-4">

                <div class="card-body">

                  <div class="pt-4 pb-2 mb-5">
                    <h1 class="card-title text-center pb-0 fs-1">Alterar senha</h1>
                    <hr class="col-md-4 m-auto mt-3">
                  </div>

                  <form action="/mudar_senha" method="post" class="row g-4 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="senha_atual" class="form-label">Senha Atual</label>
                      <div class="input-group has-validation">
                        <input type="password" name="senha_atual" class="form-control" id="senha_atual" required>
                        <div class="invalid-feedback">Por gentileza, digite o seu usuário.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="nova_senha" class="form-label">Nova Senha</label>
                      <input type="password" name="nova_senha" class="form-control" id="nova_senha" required>
                      <div class="invalid-feedback">Por gentileza, digite a sua senha.</div>
                    </div>

                    <div class="col-12">
                        <label for="confirma_senha" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" name="confirma_senha" class="form-control" id="confirma_senha" required>
                        <div class="invalid-feedback">Por gentileza, digite a sua senha.</div>
                    </div>

                    <div class="col-12 pt-4">
                      <button class="btn btn-primary w-100" type="submit">Acessar</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->