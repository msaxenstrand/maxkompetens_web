<footer class="content-info">
    <section class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <p>Maxkompetens är ett av Sveriges ledande företag inom bemanning och rekrytering.
                        Vi startade vår verksamhet 2003 och har idag verksamhet på tio orter i Sverige.
                        Varje år tillsätter vi över 1200 jobb och har dagligen
                        ca 350-400 konsulter ute på uppdrag.</p>
                    <p>Koncernbolaget Maxkompetens Sverige AB är noterat
                        på Nasdaq First North under kortnamnet MAXK.</p>
                </div>
                <div class="col-12 col-md-4 hidden-sm-down">
                    <?php
                    if (has_nav_menu('footer_navigation')) :
                        wp_nav_menu([
                            'theme_location' => 'footer_navigation',
                            'menu_class' => 'nav',
                            'menu_id' => 'footer-menu',
                            'container_id' => 'menu-container',
                            'container_class' => 'container',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker' => new Footer_Menu_Walker(),
                        ]);
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="bottom-footer">
        <div class="container">
            <div class="row social flex-items-xs-middle justify-content-center justify-content-sm-between">
                <div class="col-xs mb-3">
                    <a href="https://www.facebook.com/Maxkompetens/">
                        <i class="fa fa-facebook"aria-hidden="true"></i>
                    </a>
                    <a href="https://www.linkedin.com/company-beta/76091/">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="https://twitter.com/maxkompetens_se">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="<?= \Roots\Sage\Assets\asset_path('images/auktoriserat-bemanningsforetag.png'); ?>"
                         class="img-fluid logo pull-right"/>
                </div>
            </div>

        </div>
    </section>
</footer>
<!--<div class="scroll-top">-->
<!--  <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>-->
<!--</div>-->
<div class="overlay"></div>
