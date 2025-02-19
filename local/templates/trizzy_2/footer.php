<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
				</div><!--end .bx-content -->

				<!-- region Sidebar -->
				<?if (!$needSidebar):?>
					<div class="sidebar col-md-3 col-sm-4">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "sect",
								"AREA_FILE_SUFFIX" => "sidebar",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_MODE" => "html",
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div>
				<?endif?>
				<!--endregion -->

			</div><!--end row-->
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "sect",
					"AREA_FILE_SUFFIX" => "bottom",
					"AREA_FILE_RECURSIVE" => "N",
					"EDIT_MODE" => "html",
				),
				false,
				Array('HIDE_ICONS' => 'Y')
			);?>
		</div><!--end .container.bx-content-section-->
	</div><!--end .workarea-->

<div id="footer">

    <!-- Container -->
    <div class="container">

        <div class="four columns">
            <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-footer.png" alt="" class="margin-top-10"/>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/schedule.php"
                    ),
                    false
                );?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/personal.php"
                    ),
                    false
                );?>
        </div>

        <div class="four columns">

            <!-- Headline -->
            <h3 class="headline footer">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/about_title.php"
                    ),
                    false
                );?>
            </h3>
            <span class="line"></span>
            <div class="clearfix"></div>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_menu",
                    array(
                        "ROOT_MENU_TYPE" => "bottom",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_TYPE" => "A",
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                    ),
                    false
                );?>

        </div>

        <div class="four columns">

            <!-- Headline -->
            <h3 class="headline footer">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/catalog_title.php"
                    ),
                    false
                );?>
            </h3>
            <span class="line"></span>
            <div class="clearfix"></div>

            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_menu",
                array(
                    "ROOT_MENU_TYPE" => "left",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(),
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MAX_LEVEL" => "1",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                false
            );?>

        </div>

        <div class="four columns">

            <!-- Headline -->
            <h3 class="headline footer">Рассылка</h3>
            <span class="line"></span>
            <div class="clearfix"></div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/sender.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );?>
        </div>

    </div>
    <!-- Container / End -->
</div>
<div id="footer-bottom">

    <!-- Container -->
    <div class="container">

        <div class="eight columns">
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR."include/copyright.php"
            ), false);?>
        </div>
        <div class="eight columns">
            <ul class="payment-icons">
                <li><img src="<?= SITE_TEMPLATE_PATH ?>/images/visa.png" alt="" /></li>
                <li><img src="<?= SITE_TEMPLATE_PATH ?>/images/mastercard.png" alt="" /></li>
                <li><img src="<?= SITE_TEMPLATE_PATH ?>/images/skrill.png" alt="" /></li>
                <li><img src="<?= SITE_TEMPLATE_PATH ?>/images/moneybookers.png" alt="" /></li>
                <li><img src="<?= SITE_TEMPLATE_PATH ?>/images/paypal.png" alt="" /></li>
            </ul>
        </div>

    </div>
    </div>

<script data-cfasync="false" src="<?= SITE_TEMPLATE_PATH ?>/scripts/email-decode.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery-1.11.0.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.jpanelmenu.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.themepunch.plugins.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.themepunch.revolution.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.magnific-popup.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/hoverIntent.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/superfish.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.pureparallax.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.pricefilter.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.selectric.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.royalslider.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/SelectBox.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/modernizr.custom.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/waypoints.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.flexslider-min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.counterup.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.tooltips.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/jquery.isotope.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/puregrid.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/stacktable.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/scripts/custom.js"></script>
<script>
	BX.ready(function(){
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});
</script>
</body>
</html>