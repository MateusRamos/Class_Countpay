<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Transferência Bancária</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Transferência</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section">
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="card" style="min-height: 66vh;">
                    <div class="card-body d-flex align-items-center">

                        <div class="col-md-5">

                            <form action="/lancamento/transferencia" method="post" class="row g-4 pt-1 pb-4 d-flex justify-content-center">


                                <div class="col-md-10">
                                    <label for="id_conta_despesa" class="form-label">Conta que transferiu</label>
                                    <select class="form-select" name="id_conta_despesa" id="id_conta_despesa" required>
                                        <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                                        <option value="<?php echo htmlspecialchars( $value1["id_conta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-10">
                                    <label for="id_conta_receita" class="form-label">Conta que recebeu</label>
                                    <select class="form-select" name="id_conta_receita" id="id_conta_receita" required>
                                        <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                                        <option value="<?php echo htmlspecialchars( $value1["id_conta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label for="valor_receita" class="form-label">Valor</label>
                                    <input type="number" placeholder="R$ 00,00" name="valor" class="form-control" id="valor_receita">
                                </div>

                                <div class="col-md-5">
                                    <label for="data_receita" class="form-label">Data da transferência</label>
                                    <input type="date" class="form-control" name="data_lancamento" id="data_receita">
                                </div>

                                <div class="col-md-10 pt-4 d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary me-1">Voltar</button>
                                    <button type="submit" class="btn btn-success"
                                        style="background-color: #0AA8D0; border-color: #0AA8D0;">Transfeir</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7">
                            <img src="../../res/site/assets/img/img_transferencia.png" alt="imagem transferência"
                                style="max-width: 80vh;">
                        </div>
                    </div>
                </div>
            </div>
    </section>

</main>
<!-- End #main -->