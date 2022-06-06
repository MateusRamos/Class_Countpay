<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Despesa Única ou Fixa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="#">Lançamento</a></li>
          <li class="breadcrumb-item active"><a href="#">Nova Despesa</a></li>
          <li class="breadcrumb-item active">Despesa Única ou Fixa</li>
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
                        <form class="row g-4 pt-4 pb-4 d-flex justify-content-center">

                            <div class="col-md-10">
                                <label for="descricao_despesa" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="descricao_lancamento" id="descricao_despesa" required>
                            </div>

                            <div class="col-md-3">
                                <label for="valor_despesa" class="form-label">Valor</label>
                                <input type="number" placeholder="R$ 00,00" name="valor" class="form-control" id="valor_despesa">
                            </div>

                            <div class="col-md-4">
                              <label for="contacartao_despesa" class="form-label">Tipo Despesa</label>
                              <select class="form-select" id="contacartao_despesa" required>
                                  <option>Despesa Única</option>
                                  <option>Despesa Fixa</option>
                              </select>
                            </div>

                            <div class="col-md-3">
                                <label for="data_despesa" class="form-label">Data da Despesa</label>
                                <input type="date" class="form-control" name="data_lancamento" id="data_despesa" required>
                            </div>

                            
                            <div class="col-md-5">
                              <label for="contacartao_despesa" class="form-label">Conta/Cartão</label>
                              <select class="form-select" id="contacartao_despesa" required>
                                  <option></option>
                                  <option>Cartão Nubank Crédito</option>
                                  <option>Cartão Nubank Débito</option>
                                  <option>Cartão Inter Crédito</option>
                                  <option>Conta Corrente Itaú</option>
                                  <option>Conta Binance 2</option>
                              </select>
                          </div>


                            <div class="col-md-5 mb-3">
                                <label for="categoria_despesa" class="form-label">Categoria</label>
                                <select class="form-select" id="categoria_despesa" required>
                                    <option></option>
                                    <option>Alimentação</option>
                                    <option>Transporte</option>
                                    <option>Cuidados Pessoais</option>
                                    <option>Lazer</option>
                                    <option>Vestuário</option>
                                    <option>Investimento</option>
                                    <option>Saúde</option>
                                    <option>Outros</option>
                                </select>
                            </div>

                            <div class="col-md-9 d-flex justify-content-center">
                              <button type="button" class="btn btn-secondary me-1">Cancelar</button>
                              <button type="button" class="btn btn-success" style="background-color: #E54640; border-color: #E54640;">Salvar Despesa</button>
                            </div>
                        </form>
                      </div>
                        <div class="col-md-5">
                          <img src="../../res/site/assets/img/img_despesa_unica.png" alt="Despesa Única" style="max-height: 66vh;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main>
  <!-- End #main -->