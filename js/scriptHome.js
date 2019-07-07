    $(document).ready(function(){
      var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,/*número de slides por visualização*/
      spaceBetween: 1, /*distância entre slides em px*/
      slidesPerGroup: 1,/*número de slides para definir e ativar o deslizamento de grupo*/
      loop: true,/*ativa modo loop (repetição infinita)*/
      loopFillGroupWithBlank: true,/* irá preencher grupos com número insuficiente de slides com slides em branco*/
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
});