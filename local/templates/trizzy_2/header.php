<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));

\Bitrix\Main\UI\Extension::load(["ui.bootstrap4", "ui.fonts.opensans"]);

if (isset($_GET["theme"]) && in_array($_GET["theme"], array("blue", "green", "yellow", "red")))
{
	COption::SetOptionString("main", "wizard_eshop_bootstrap_theme_id", $_GET["theme"], false, SITE_ID);
}
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "green", SITE_ID);

$curPage = $APPLICATION->GetCurPage(true);

$scriptPath = SITE_TEMPLATE_PATH . "/scripts";
$scripts = glob($_SERVER["DOCUMENT_ROOT"] . $scriptPath . "/*.js");

foreach ($scripts as $script) {
    $scriptUrl = str_replace($_SERVER["DOCUMENT_ROOT"], '', $script);
    echo '<script src="' . $scriptUrl . '"></script>' . PHP_EOL;
}


?><!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <? $APPLICATION->ShowHead(); ?>
</head>
<body class="bx-background-image bx-theme-<?=$theme?>" <?$APPLICATION->ShowProperty("backgroundImage");?>>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<div id="top-bar">
    <div class="container">

        <!-- Top Bar Menu -->
        <div class="ten columns">
            <ul class="top-bar-menu">
                <li><i class="fa fa-phone"></i> (564) 123 4567</li>
                <li><i class="fa fa-envelope"></i> <a href="#"><span class="__cf_email__" data-cfemail="2b464a42476b4e534a465b474e05484446">[email&#160;protected]</span></a></li>
                <li>
                    <div class="top-bar-dropdown">
                        <span>English</span>
                        <ul class="options">
                            <li><div class="arrow"></div></li>
                            <li><a href="#">English</a></li>
                            <li><a href="#">Polish</a></li>
                            <li><a href="#">Deutsch</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="top-bar-dropdown">
                        <span>USD</span>
                        <ul class="options">
                            <li><div class="arrow"></div></li>
                            <li><a href="#">USD</a></li>
                            <li><a href="#">PLN</a></li>
                            <li><a href="#">EUR</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Social Icons -->
        <div class="six columns">
            <ul class="social-icons">
                <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                <li><a class="dribbble" href="#"><i class="icon-dribbble"></i></a></li>
                <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                <li><a class="pinterest" href="#"><i class="icon-pinterest"></i></a></li>
            </ul>
        </div>

    </div>
</div>

<div class="clearfix"></div>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "bootstrap_v5",
    array(
        "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
        "SHOW_PERSONAL_LINK" => "N",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_TOTAL_PRICE" => "Y",
        "SHOW_PRODUCTS" => "N",
        "POSITION_FIXED" =>"N",
        "SHOW_AUTHOR" => "Y",
        "PATH_TO_REGISTER" => SITE_DIR."login/",
        "PATH_TO_PROFILE" => SITE_DIR."personal/"
    ),
    false,
    array()
);?>
<div class="bx-wrapper" id="bx_eshop_wrap">
	<header class="bx-header">
		<div class="bx-header-section container">
			<!--region bx-header-->
			<div class="row pt-0 pt-md-3 mb-3 align-items-center" style="position: relative;">
				<div class="d-block d-md-none bx-menu-button-mobile" data-role='bx-menu-button-mobile-position'></div>
				<div class="col-12 col-md-auto bx-header-logo">
					<a class="bx-logo-block d-none d-md-block" href="<?=SITE_DIR?>">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/company_logo.php"),
							false
						);?>
					</a>
					<a class="bx-logo-block d-block d-md-none text-center" href="<?=SITE_DIR?>">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/company_logo_mobile.php"
							),
							false
						);?>
					</a>
				</div>

				<div class="col bx-header-contact">
					<div class="d-flex align-items-center justify-content-between justify-content-md-center flex-column flex-sm-row flex-md-column flex-lg-row">
						<div class="p-lg-3 p-1">
							<div class="bx-header-phone-block">
								<i class="bx-header-phone-icon"></i>
								<span class="bx-header-phone-number">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/telephone.php"
										),
										false
									);?>
								</span>
							</div>
						</div>
						<div class="p-lg-3 p-1">
							<div class="bx-header-worktime">
								<div class="bx-worktime-title"><?=GetMessage('HEADER_WORK_TIME'); ?></div>
								<div class="bx-worktime-schedule">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/schedule.php"
										),
										false
									);?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--endregion-->

			<!--region menu-->
			<div class="row mb-4 d-none d-md-block">
				<div class="col">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bootstrap_v4",
						array(
							"ROOT_MENU_TYPE" => "left",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_THEME" => "site",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
							"COMPONENT_TEMPLATE" => "bootstrap_v4"
						),
						false
					);?>
				</div>
			</div>
			<!--endregion-->

			<!--region search.title -->
			<?php
			if ($curPage != SITE_DIR."index.php"):
				if (\Bitrix\Main\ModuleManager::isModuleInstalled('search')):
				?>
				<div class="row mb-4">
					<div class="col">
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.title",
							"bootstrap_v4",
							array(
								"NUM_CATEGORIES" => "1",
								"TOP_COUNT" => "5",
								"CHECK_DATES" => "N",
								"SHOW_OTHERS" => "N",
								"PAGE" => SITE_DIR."catalog/",
								"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
								"CATEGORY_0" => array(
									0 => "iblock_catalog",
								),
								"CATEGORY_0_iblock_catalog" => array(
									0 => "all",
								),
								"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
								"SHOW_INPUT" => "Y",
								"INPUT_ID" => "title-search-input",
								"CONTAINER_ID" => "search",
								"PRICE_CODE" => array(
									0 => "BASE",
								),
								"SHOW_PREVIEW" => "Y",
								"PREVIEW_WIDTH" => "75",
								"PREVIEW_HEIGHT" => "75",
								"CONVERT_CURRENCY" => "Y"
							),
							false
						);?>
					</div>
				</div>
			<?php
				endif;
			endif;
			?>
			<!--endregion-->

			<!--region breadcrumb-->
			<?if ($curPage != SITE_DIR."index.php"):?>
				<div class="row mb-4">
					<div class="col" id="navigation">
						<?$APPLICATION->IncludeComponent(
							"bitrix:breadcrumb",
							"universal",
							array(
								"START_FROM" => "0",
								"PATH" => "",
								"SITE_ID" => "-"
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div>
				</div>
				<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>
			<?endif?>
			<!--endregion-->
		</div>
	</header>

	<div class="workarea">
		<div class="container bx-content-section">
			<div class="row">
			<?$needSidebar = preg_match("~^".SITE_DIR."(catalog|personal\/cart|personal\/order\/make)/~", $curPage);?>
				<div class="bx-content <?=($needSidebar ? "col" : "col-md-9 col-sm-8")?>">