<?php if(!class_exists('Rain\Tpl')){exit;}?>  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer pb-0">
    <div class="copyright">
      <div class="text-lg-center">&copy; Equipe<strong> Countpay 2022</strong></div>
      <div class="text-lg-center"><small>Website built with NiceAdmin by BootstrapMade with Illustrations by Stories by
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