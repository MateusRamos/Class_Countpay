<?php if(!class_exists('Rain\Tpl')){exit;}?><main id="main" class="main">
    <div class="pagetitle">
        <h1>Contato</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Contato</li>
            </ol>
        </nav>
    </div>
    <section class="section contact">
        <div class="row gy-4">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card"> <i class="bi bi-geo-alt"></i>
                            <h3>Endereço</h3>
                            <p>Rua Tiradentes, 597s<br>Birigui, SP 16.201-008</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card"> <i class="bi bi-telephone"></i>
                            <h3>Telefone para contato</h3>
                            <p>+55 (18) 99716-9693<br>+55 (18) 99650-4786</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card"> <i class="bi bi-envelope"></i>
                            <h3>E-mail para contato</h3>
                            <p>info@countpay.com.br<br>Suporte@countpay.com.br</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card"> <i class="bi bi-clock"></i>
                            <h3>Horario de atendimento</h3>
                            <p>Segunda-feira a Sexta-feira<br>9:00hrs - 17hrs</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card p-4">
                    <form action="/contato" method="post" class="php-email-form">
                        <div class="row gy-4">
                            <div class="col-md-6"> 
                                <input type="text" name="nome" class="form-control" placeholder="Seu nome" required="">
                                </div>
                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Seu e-mail" required="">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="assunto" placeholder="Assunto" required="">
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="mensagem" rows="6" placeholder="Mensagem" required=""></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="loading">Carregando</div>
                                <div class="error-message">Erro ao enviar mensagem!</div>
                                <div class="sent-message">Sua mensagem foi enviada com sucesso! Agradeçemos o contato.</div> 
                                <button type="submit">Enviar Mensagem</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>