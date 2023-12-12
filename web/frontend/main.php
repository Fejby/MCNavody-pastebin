<?php
$urls = Config::Get('urls');
$legal = Config::Get('legal');
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8" />
        <meta name="theme-color" content="#2ECC71" />

        <title>MC Návody</title>

        <base href="/" />

        <link rel="stylesheet" href="vendor/fonts/fonts.css" />
        <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css" />
        <link rel="stylesheet" href="css/btn.css" />
        <link rel="stylesheet" href="css/mclogs.css?v=071224" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

        <meta name="description" content="Snadno vkládejte své logy z Minecraftu, sdílejte je a analyzujte.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <script>
            let _paq = window._paq = window._paq || [];
            _paq.push(['disableCookies']);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                _paq.push(['setTrackerUrl', '/data']);
                _paq.push(['setSiteId', '5']);
                let d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src='/data.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
    </head>
    <body>
        <header class="row navigation">
            <div class="row-inner">
                <a href="/" class="logo">
                    <img src="img/logo.png" />
                </a>
                <div class="menu">
                    <a class="menu-item" href="https://mcnavody.eu/">
                        <i class="fa fa-book"></i> Wiki
                    </a>
                    <a class="menu-item" href="https://discord.mcnavody.eu/">
                        <i class="fab fa-discord"></i> Discord
                    </a>
                </div>
            </div>
        </header>
        <div class="row dark title">
            <div class="row-inner">
                <h1 class="title-container">
                    <span class="title-verb">Vlož</span> svůj log z Minecraftu.
                </h1>
            </div>
        </div>
        <div class="row dark paste">
            <div class="row-inner">
                <div class="paste-box">
                    <div class="paste-header">
                        <div class="paste-header-text">
                            Zde vložte log nebo <span class="btn btn-small btn-no-margin" id="paste-select-file"><i class="fa fa-file-import"></i> Zvolte soubor</span>
                        </div>
                        <div class="paste-save btn btn-green btn-no-margin">
                            <i class="fa fa-save"></i> Uložit
                        </div>
                    </div>
                    <div id="dropzone" class="paste-body">
                        <textarea id="paste" autocomplete="off" spellcheck="false"></textarea>
                    </div>
                    <div class="paste-footer">
                        <div class="paste-save btn btn-green btn-no-margin">
                            <i class="fa fa-save"></i> Uložit
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row dark plugin" id="plugin">
            <div class="row-inner">
                <div class="article left">
                    <div class="article-icon">
                        <i class="fa fa-code"></i>
                    </div>
                    <div class="article-info">
                        <div class="article-title">
                            Použij náš plugin.
                        </div>
                        <div class="article-text">
                            Pomocí našeho pluginu můžete sdílet log Minecraftu přímo ze serveru pomocí jednoho jednoduchého příkazu.
                            Soukromé informace, jako jsou IP adresy, jsou automaticky skryty, aby byla zajištěna bezpečnost a soukromí.
                        </div>
                        <div class="article-buttons">
                            <a href="https://github.com/Fejby/MCNavody-plugin/releases" target="_blank" class="btn btn-blue btn-no-margin">
                                <i class="fa fa-download"></i> Github
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="row footer">
            <div class="row-inner">
                MC Návody <?=date("Y"); ?>
            </div>
        </div>
        <script src="js/mclogs.js?v=130221"></script>
    </body>
</html>
