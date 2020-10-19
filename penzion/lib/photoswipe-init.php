
<link rel="stylesheet" href="lib/PhotoSwipe/dist/photoswipe.css"> 
<link rel="stylesheet" href="lib/PhotoSwipe/dist/default-skin/default-skin.css"> 
<script src="lib/PhotoSwipe/dist/photoswipe.min.js"></script> 
<script src="lib/PhotoSwipe/dist/photoswipe-ui-default.min.js"></script> 

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        
        <!-- Background of PhotoSwipe. 
        It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

    <!-- Container that holds slides. 
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
    <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
    </div>

    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
    <div class="pswp__ui pswp__ui--hidden">

        <div class="pswp__top-bar">

            <!--  Controls are self-explanatory. Order can be changed. -->

            <div class="pswp__counter"></div>

            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

            <button class="pswp__button pswp__button--share" title="Share"></button>

            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

            <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
            <!-- element will get class pswp__preloader--active when preloader is running -->
            <div class="pswp__preloader">
                <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                    <div class="pswp__preloader__donut"></div>
                </div>
                </div>
            </div>
        </div>

        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div> 
        </div>

        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
        </button>

        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
        </button>

        <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
        </div>

    </div>

    </div>

</div>

<script>
    // pole obrazku do galerie, postupne naplnime
    var items = [];
    
    //Projdeme vsechny elementy a (odkazy)
    $('a').each((index, element) => {

        //kdyz odkaz obsahuje element img
        if ( $(element).find('img').length > 0 ) {

            var odkazObrazku = $(element).attr("href");

            var obrazek = new Image();
            obrazek.src = odkazObrazku;
            obrazek.onload = () => {

                items.push({
                    src : odkazObrazku,
                    w: obrazek.width,
                    h: obrazek.height,
                })
            }

            //pridame posluchace na click daneho odkazu
            $(element).on('click', (udalost) => {
                //zneaktivnit defultni chovani odkazu
                //po kliknuti chceme zobrazit galerii
                udalost.preventDefault();

                var pswpElement = document.querySelectorAll('.pswp')[0];
                var options = {
                    index: items.findIndex((item) => {return odkazObrazku == item.src;})
                };

                var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();

            })
        }

    })

</script>
