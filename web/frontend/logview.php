<?php
$urls = Config::Get('urls');
$legal = Config::Get('legal');
$id = new Id(substr($_SERVER['REQUEST_URI'], 1));
$log = new Log($id);
$shouldWrapLogLines = filter_var($_COOKIE["WRAP_LOG_LINES"] ?? "true", FILTER_VALIDATE_BOOLEAN);

$title = "MC Návody";
$description = "Snadno vkládejte své logy z Minecraftu, sdílejte je a analyzujte.";
if (!$log->exists()) {
    $title = "MC Návody - Log nebyl nalezen";
    http_response_code(404);
} else {
    $codexLog = $log->get();
    $analysis = $log->getAnalysis();
    $information = $analysis->getInformation();
    $problems = $analysis->getProblems();
    $title = $codexLog->getTitle() . " [#" . $id->get() . "]";
    $lineNumbers = $log->getLineNumbers();
    $lineString = $lineNumbers === 1 ? "řádek" : $lineString = $lineNumbers === 2 ? "řádky" : $lineString = $lineNumbers === 3 ? "řádky" : $lineString = $lineNumbers === 4 ? "řádky" : "řádků";

    $errorCount = $log->getErrorCount();
    $errorString = $errorCount === 1 ? "chyba" : $errorString = $errorCount === 2 ? "chyby" : $errorString = $errorCount === 3 ? "chyby" : $errorString = $errorCount === 4 ? "chyby" : "chyb";

    $description = $lineNumbers . " " . $lineString;
    if ($errorCount > 0) {
       $description .= " | " . $errorCount . " " . $errorString;
    }

    if (count($problems) > 0) {
        $problemString = "problémů";
        if (count($problems) === 1) {
            $problemString = "problém";
        }
        if (count($problems) === 2) {
            $problemString = "problémy";
        }
        if (count($problems) === 3) {
            $problemString = "problémy";
        }
        if (count($problems) === 4) {
            $problemString = "problémy";
        }
        $description .= " | " . count($problems) . " " . $problemString . " automaticky detekováno";
    }
}
?><!DOCTYPE html>
<html lang="">
    <head>
        <meta name="robots" content="noindex,nofollow">
        <meta charset="utf-8" />
        <meta name="theme-color" content="#2d3943" />

        <title><?=$title; ?> - mclo.gs</title>

        <base href="/" />

        <link rel="stylesheet" href="vendor/fonts/fonts.css" />
        <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css" />
        <link rel="stylesheet" href="css/btn.css" />
        <link rel="stylesheet" href="css/mclogs.css?v=071224" />
        <link rel="stylesheet" href="css/log.css?v=071222" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

        <meta name="description" content="<?=$description; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="mclo.gs" />
        <meta property="og:title" content="<?=$title; ?>" />
        <meta property="og:description" content="<?=$description; ?>" />
        <meta property="og:url" content="<?=$urls['baseUrl'] . "/" . $id->get(); ?>" />

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
    <body class="log-body">
        <header class="row navigation">
            <div class="row-inner">
                <a href="/" class="logo">
                    <img src="img/logo.png" alt=""/>
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
        <div class="row dark log-row">
            <div class="row-inner<?= $shouldWrapLogLines ? "" : " no-wrap"?>">
                <?php if($log->exists()): ?>
                <div class="log-info">
                    <div class="log-title">
                        <h1><i class="fas fa-file-lines"></i> <?=$codexLog->getTitle(); ?></h1>
                        <div class="log-id">#<?=$id->get(); ?></div>
                    </div>
                    <div class="log-info-actions">
                        <?php if($errorCount): ?>
                        <div class="btn btn-red btn-small btn-no-margin" id="error-toggle">
                            <i class="fa fa-exclamation-circle"></i>
                            <?=$errorCount . " " . $errorString; ?>
                        </div>
                        <?php endif; ?>
                        <div class="btn btn-blue btn-small btn-no-margin" id="down-button">
                            <i class="fa fa-arrow-circle-down"></i>
                            <?=$lineNumbers . " " . $lineString; ?>
                        </div>
                        <a class="btn btn-white btn-small btn-no-margin" id="raw" target="_blank" href="<?=$urls['apiBaseUrl'] . "/1/raw/". $id->get()?>">
                            <i class="fa fa-arrow-up-right-from-square"></i>
                            Raw
                        </a>
                    </div>
                </div>
                <?php if(count($analysis) > 0): ?>
                    <div class="analysis">
                        <div class="analysis-headline"><i class="fa fa-info-circle"></i> Analýza</div>
                        <?php if(count($information) > 0): ?>
                            <div class="information-list">
                                <?php foreach($information as $info): ?>
                                    <div class="information">
                                        <div class="information-label">
                                            <?=$info->getLabel(); ?>:
                                        </div>
                                        <div class="information-value">
                                            <?=$info->getValue(); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(count($problems) > 0): ?>
                            <div class="problem-list">
                                <?php foreach($problems as $problem): ?>
                                    <div class="problem">
                                        <div class="problem">
                                            <div class="problem-header">
                                                <div class="problem-message">
                                                    <i class="fa fa-exclamation-triangle"></i> <?=htmlspecialchars($problem->getMessage()); ?>
                                                </div>
                                                <?php $number = $problem->getEntry()[0]->getNumber(); ?>
                                                <a href="/<?=$id->get() . "#L" . $number; ?>" class="btn btn-blue btn-no-margin btn-small" onclick="updateLineNumber('#L<?=$number; ?>');">
                                                    <span class="hide-mobile"><i class="fa fa-arrow-right"></i> Line </span>#<?=$number; ?>
                                                </a>
                                            </div>
                                            <div class="problem-body">
                                                <div class="problem-solution-headline">
                                                    Solutions
                                                </div>
                                                <div class="problem-solution-list">
                                                    <?php foreach($problem->getSolutions() as $solution): ?>
                                                        <div class="problem-solution">
                                                            <?=preg_replace("/'([^']+)'/", "'<strong>$1</strong>'", htmlspecialchars($solution->getMessage())); ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="log">
                    <?php
                        $log->renew();
                        echo $log->getPrinter()->print();
                    ?>
                </div>
                <div class="log-bottom">
                    <div class="btn btn-blue btn-small btn-notext" id="up-button">
                        <i class="fa fa-arrow-circle-up"></i>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="wrap-checkbox"<?=$shouldWrapLogLines ? " checked" : ""?>/>
                        <label for="wrap-checkbox">Zalomit řádky logu</label>
                    </div>
                </div>
                <div class="log-notice">
                    Tento protokol bude uložen po dobu 90 dnů od jejich posledního zobrazení.<br />
                <a href="mailto:podpora@mcnavody.eu?subject=Pastebin/<?=$id->get(); ?>">Nahlásit problém</a>
                </div>
                <?php else: ?>
                <div class="not-found">
                    <div class="not-found-title">404 - Protokol nebyl nalezen.</div>
                    <div class="not-found-text">Protokol, který se snažíte otevřít, již neexistuje.<br />Všechny protokoly, které nebyly otevřeny v posledních 90 dnech, automaticky mažeme.</div>
                    <div class="not-found-buttons">
                        <a href="/" class="btn btn-no-margin btn-blue btn-small">
                            <i class="fa fa-home"></i> Vložit nový protokol
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row footer">
            <div class="row-inner">
                MC Návody <?=date("Y"); ?>
            </div>
        </div>
        <script src="js/logview.js?v=130221"></script>
    </body>
</html>
