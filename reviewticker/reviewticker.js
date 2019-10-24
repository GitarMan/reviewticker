(function() {

    class ReviewTicker {
        constructor(container) {
            this.nodeList = container.getElementsByClassName('reviewticker__review');
            this.slides = Array.from(this.nodeList); 
            this.clickArea = container.getElementsByClassName('reviewticker')[0];
            this.slideIndex = 0;
            this.numberOfSlides = this.slides.length;
            this.delay = ( !phpVars.delaySecs ? 5*1000 : phpVars.delaySecs*1000 );
            this.timer = setInterval( this.showNextSlide.bind(this), 
                                      this.delay );
            this.init();
        }

        init() {
            this.slides[this.slideIndex].style.display = "block";
            this.clickArea.addEventListener( "click", this.showNextSlide.bind(this) );
        }

        advanceIndex() {
            if ( this.slideIndex >= this.numberOfSlides-1 ) {
                this.slideIndex = 0;
            } else {
                this.slideIndex++;
            }
        }

        clearSlides() {
            this.slides.forEach(function(slide){
                slide.style.display = "none";
            });
        }

        showNextSlide() {
            this.advanceIndex();
            this.clearSlides();
            this.slides[this.slideIndex].style.display = "block";
        }
    }

    var shortcodeElement = document.getElementById('reviewticker-shortcode'); 
    shortcodeReviewticker = new ReviewTicker( shortcodeElement );


    var footerElement = document.getElementById('reviewticker-footer'); 
    footerReviewticker = new ReviewTicker( footerElement );

})();

