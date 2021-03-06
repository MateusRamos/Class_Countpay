<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Inicio do Conteúdo da Pagina -->
    <main id="main" class="main">

        <!-- Inicio Título da Pagina -->
        <div class="pagetitle">
            <h1>Projeções Futuras</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item active">Projeções Futuras</li>
                </ol>
            </nav>
        </div>
        <!-- Fim Título da Pagina -->

        <!-- Inicio Título da Pagina -->
        <section class="section dashboard">

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 60vh;">

                            <!-- Projeções Futuras -->
                            <div class="col-md-12 mt-2">

                                <div id="body">

                                    <div id="section">

                                        <div class="swiper mySwiper container">
                                            <div class="swiper-wrapper content">

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Janeiro</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["01"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["01"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["01"]["receita"] - $dados["01"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal()">Abrir mês</a>
                                                            </div>

                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal2()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Fevereiro</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["02"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["02"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["02"]["receita"] - $dados["02"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal2()">Abrir mês</a>
                                                            </div>

                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal3()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Março</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["03"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["03"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["03"]["receita"] - $dados["03"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal3()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal4()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Abril</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["04"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["04"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["04"]["receita"] - $dados["04"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal4()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal5()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Maio</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["05"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["05"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["05"]["receita"] - $dados["05"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal5()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal6()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Junho</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["06"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["06"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["06"]["receita"] - $dados["06"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal6()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal7()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Julho</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["07"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["07"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["07"]["receita"] - $dados["07"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal7()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal8()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Agosto</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["08"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["08"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["08"]["receita"] - $dados["08"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal8()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal9()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Setembro</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["09"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["09"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["09"]["receita"] - $dados["09"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal9()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal10()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Outubro</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["10"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["10"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["10"]["receita"] - $dados["10"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal10()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal11()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Novembro</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["11"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["11"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["11"]["receita"] - $dados["11"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal11()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="swiper-slide card bg-light">

                                                    <a href="#" onclick="mostrar_modal12()" data-toggle="modal"
                                                        data-target="">
                                                        <div class="card-content">
                                                            <div class="name-profession text-white">
                                                                <span class="name">Dezembro</span>
                                                                <span class="profession">Mês Atual</span>
                                                            </div>

                                                            <div class="rating pt-5 text-black">

                                                                <p>
                                                                    <b>Receita:</b> R$<?php echo htmlspecialchars( $dados["12"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br> 
                                                                    <b>Despesa:</b> R$<?php echo htmlspecialchars( $dados["12"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                                                    </br>
                                                                    <b>Saldo:</b> R$<?php echo htmlspecialchars( $dados["12"]["receita"] - $dados["12"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?><b></b>
                                                                </p>

                                                            </div>

                                                            <div class="button d-flex justify-content-center">
                                                                <a class="btn btn-primary"
                                                                    onclick="mostrar_modal12()">Abrir mês</a>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>

                                </div>
                            </div>


                            <!-- Modal Janeiro -->
                            <div class="modal fade" id="minha_caixa" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Janeiro</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["01"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["01"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["01"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/01/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="31/01/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Fevereiro -->
                            <div class="modal fade" id="minha_caixa2" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Fevereiro</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["02"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["02"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["02"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/02/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="28/02/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Março -->
                            <div class="modal fade" id="minha_caixa3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Março</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["03"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["03"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["03"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/03/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="31/03/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Abril -->
                            <div class="modal fade" id="minha_caixa4" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Abril</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["04"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["04"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["04"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/04/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="30/04/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Maio -->
                            <div class="modal fade" id="minha_caixa5" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Maio</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["05"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["05"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["05"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/05/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="31/05/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Junho -->
                            <div class="modal fade" id="minha_caixa6" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Junho</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["06"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["06"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["06"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/06/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="30/06/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Julho -->
                            <div class="modal fade" id="minha_caixa7" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Julho</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["07"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["07"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["07"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/07/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="31/07/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Agosto -->
                            <div class="modal fade" id="minha_caixa8" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Agosto</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["08"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["08"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["08"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/08/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="30/08/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Setembro -->
                            <div class="modal fade" id="minha_caixa9" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Setembro</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["09"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["09"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["09"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/09/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="31/09/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Outubro -->
                            <div class="modal fade" id="minha_caixa10" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Outubro</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["10"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["10"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["10"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/10/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="30/10/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Novembro -->
                            <div class="modal fade" id="minha_caixa11" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Novembro</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["11"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["11"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["11"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/11/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="31/11/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Novembro -->
                            <div class="modal fade" id="minha_caixa12" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex" id="exampleModalLabel"><b>Dezembro</b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-success"></i>
                                                        Receita:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["12"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bx bxs-dollar-circle text-danger"></i>
                                                        Despesa:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["12"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="bi bi-credit-card-fill text-primary"></i>
                                                        Fatura total:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="R$ <?php echo htmlspecialchars( $dados["12"]["fatura"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Inicial:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="01/12/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-md-4 col-form-label"><i
                                                            class="ri-calendar-event-fill text-secondary"></i> Data
                                                        Final:</label>
                                                    <div class="col-md-8">
                                                        <input readonly class="form-control-plaintext" value="30/12/2022" style="font-family: 'Overpass', sans-serif;">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>





                    </div>
                </div>
            </div>
            </div>




        </section>
        <!-- Fim Título da Pagina -->

    </main>
    <!-- Final do main -->



















    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer pb-0">
        <div class="copyright">
            <div class="text-lg-center">&copy; Equipe<strong> Countpay 2022</strong></div>
            <div class="text-lg-center"><small>Website built with NiceAdmin by BootstrapMade with Illustrations by
                    Stories by
                    Freepik.</small></p>
            </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../res/site/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../res/site/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../res/site/assets/vendor/chart.js/chart.min.js"></script>
    <script src="../../res/site/assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../res/site/assets/vendor/quill/quill.min.js"></script>
    <script src="../../res/site/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../res/site/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../res/site/assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="../res/site/assets/js/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $("#telefone, #celular").mask("(00) 00000-0000");
    </script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 25,
            slidesPerGroup: 1,
            loop: false,
            loopFillGroupWithBlank: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            }
        });
    </script>

    <script>
        function mostrar_modal() {
            let el = document.getElementById('minha_caixa');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal2() {
            let el = document.getElementById('minha_caixa2');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal3() {
            let el = document.getElementById('minha_caixa3');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal4() {
            let el = document.getElementById('minha_caixa4');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal5() {
            let el = document.getElementById('minha_caixa5');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal6() {
            let el = document.getElementById('minha_caixa6');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal7() {
            let el = document.getElementById('minha_caixa7');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal8() {
            let el = document.getElementById('minha_caixa8');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal9() {
            let el = document.getElementById('minha_caixa9');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal10() {
            let el = document.getElementById('minha_caixa10');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal11() {
            let el = document.getElementById('minha_caixa11');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function mostrar_modal12() {
            let el = document.getElementById('minha_caixa12');
            let minha_modal = new bootstrap.Modal(el);
            minha_modal.show();
        }

        function fechar() {
            let modal = document.querySelector('.modal')

            modal.style.display = 'none';
            $(".modal-backdrop").css("display", "none");
        }
    </script>


    </body>

    </html>