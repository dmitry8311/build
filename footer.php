<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aarsleff
 */

?>


    <footer class="footer full-width">

        <div class="footer-inner">

            <div class="footer-inner-logo">

                <?php dynamic_sidebar( 'footer_area_one' ); ?>

            </div>

            <div class="footer-inner-contact">

                <?php dynamic_sidebar( 'footer_area_two' ); ?>

            </div>

            <div class="footer-inner-menu">

                <?php dynamic_sidebar( 'footer_area_three' ); ?>

            </div>

            <div class="footer-inner-newsletter">

                <?php dynamic_sidebar( 'footer_area_four' ); ?>

                <!-- Rapidmail Form -->
                <div id="rmOrganism">
                    <div class="rmEmbed rmLayout--vertical rmBase">
                        <div data-page-type="formSubscribe" class="rmBase__body rmSubscription">
                            <form method="post" action="https://t4cb3b940.emailsys1a.net/236/1983/d66131863a/subscribe/form.html?_g=1730109553" class="rmBase__content">
                                <div class="rmBase__container">
                                    <div class="rmBase__section">
                                        <div class="rmBase__el rmBase__el--input rmBase__el--label-pos-none" data-field="email">
                                            <label for="email" class="rmBase__compLabel rmBase__compLabel--hideable">
                                                E-Mail-Adresse
                                            </label>
                                            <div class="rmBase__compContainer">
                                                <input type="text" name="email" id="email" placeholder="E-Mail-Adresse" value="" class="rmBase__comp--input comp__input">
                                                <div class="rmBase__compError"></div>
                                            </div>
                                        </div>
                                        <div class="rmBase__el rmBase__el--cta">
                                            <button type="submit" class="rmBase__comp--cta">
                                                anmelden
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div data-page-type="pageSubscribeSuccess" class="rmBase__body rmSubscription hidden">
                            <div class="rmBase__content">
                                <div class="rmBase__container">
                                    <div class="rmBase__section">
                                        <div class="rmBase__el rmBase__el--heading">
                                            <div class="rmBase__comp--heading">
                                                Vielen Dank für Ihre Anmeldung!
                                                <!-- this linebreak is important, don't remove it! this will force trailing linebreaks to be displayed -->
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rmBase__section">
                                        <div class="rmBase__el rmBase__el--text">
                                            <div class="rmBase__comp--text">
                                                Wir haben Ihnen auch schon die erste E-Mail geschickt und bitten Sie, Ihre E-Mail-Adresse über den Aktivierungslink zu bestätigen.
                                                <!-- this linebreak is important, don't remove it! this will force trailing linebreaks to be displayed -->
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="footer-newsletter-text">Und folgen Sie uns auf den Sozialen Netzen</p>


                <script src="https://t4cb3b940.emailsys1a.net/form/236/1983/90b7a9fb72/embedded.js" async></script>
                <!-- End Rapidmail Form -->
            </div>

        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
