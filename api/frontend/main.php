<?php
$urls = Config::Get("urls");
$legal = Config::Get('legal');
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8" />
        <meta name="theme-color" content="#2ECC71"/>

        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Play:400,700">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:300,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet" />

    <title>API Dokumentace - MC Návody</title>

        <base href="//<?= str_replace("api.", "log.", $_SERVER['HTTP_HOST']); ?>/"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <link rel="stylesheet" href="css/btn.css" />
        <link rel="stylesheet" href="css/mclogs.css?v=071224" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

       <meta name="description" content="Snadno vkládejte své záznamy z Minecraftu, sdílejte je a analyzujte.">
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
            <img src="img/logo.png" alt=""/>
        </a>
        <div class="menu">
            <a class="menu-item" href="https://mcnavody.eu/">
                <i class="fa-solid fa-book"></i> Wiki
            </a>
            <a class="menu-item" href="https://discord.mcnavody.eu/">
                <i class="fa-brands fa-discord"></i> Discord
            </a>
        </div>
    </div>
</header>
        <div class="row docs dark">
            <div class="row-inner">
                <div class="docs-text">
                    <h1 class="docs-title">Dokumentace API</h1>
            Integrujte <strong>log.mcnavody.eu</strong> přímo do svého serverového panelu, hostingového softwaru nebo
            čehokoli jiného. Tato platforma
            byla vytvořena pro vysoce výkonnou automatizaci a lze ji snadno integrovat do jakéhokoli stávajícího
            softwaru prostřednictvím naší
            HTTP API.
                </div>
                <div class="docs-icon">
                    <i class="fa fa-code"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row-inner">
                <h2>Paste a log file</h2>

                <div class="endpoint">
                    <span class="method">POST</span> <span class="endpoint-url"><?=$urls['apiBaseUrl']?>/1/log</span> <span class="content-type">application/x-www-form-urlencoded</span>
                </div>
                <table class="endpoint-table">
                    <tr>
                        <th>Pole</th>
                        <th>Typ</th>
                        <th>Popis</th>
                    </tr>
                    <tr>
                        <td class="endpoint-field">content</td>
                        <td class="endpoint-type">string</td>
                        <td class="endpoint-description">The raw log file content as string. Maximum length is 10MiB and 25k lines, will be shortened if necessary.</td>
                    </tr>
                </table>

                <h3>Success <span class="content-type">application/json</span></h3>
                <pre class="answer">
{
    "success": true,
    "id": "8FlTowW",
    "url": "<?=$urls['baseUrl']?>/8FlTowW",
    "raw": "<?=$urls['apiBaseUrl']?>/1/raw/8FlTowW"
}</pre>
                <h3>Chyba <span class="content-type">application/json</span></h3>
                <pre class="answer">
{
    "success": false,
    "error": "Required POST argument 'content' is empty."
}</pre>
            </div>
        </div>
        <div class="row">
            <div class="row-inner">
                <h2>Get the raw log file content</h2>
                <div class="endpoint">
                    <span class="method">GET</span> <span class="endpoint-url"><?=$urls['apiBaseUrl']?>/1/raw/[id]</span>
                </div>
                <table class="endpoint-table">
                    <tr>
                        <th>Pole</th>
                        <th>Typ</th>
                        <th>Popis</th>
                    </tr>
                    <tr>
                        <td class="endpoint-field">[id]</td>
                        <td class="endpoint-type">string</td>
                        <td class="endpoint-description">The log file id, received from the paste endpoint or from a URL (<?=$urls['baseUrl']?>/[id]).</td>
                    </tr>
                </table>

                <h3>Success <span class="content-type">text/plain</span></h3>
                <pre class="answer">
[18:25:33] [Server thread/INFO]: Starting minecraft server version 1.16.2
[18:25:33] [Server thread/INFO]: Loading properties
[18:25:34] [Server thread/INFO]: Default game type: SURVIVAL
...
</pre>
                <h3>Chyba <span class="content-type">application/json</span></h3>
                <pre class="answer">
{
    "success": false,
    "error": "Log not found."
}</pre>
            </div>
        </div>
        <div class="row">
            <div class="row-inner">
                <h2>Get insights</h2>

                <div class="endpoint">
                    <span class="method">GET</span> <span class="endpoint-url"><?=$urls['apiBaseUrl']?>/1/insights/[id]</span>
                </div>
                <table class="endpoint-table">
                    <tr>
                        <th>Pole</th>
                        <th>Typ</th>
                        <th>Popis</th>
                    </tr>
                    <tr>
                        <td class="endpoint-field">[id]</td>
                        <td class="endpoint-type">string</td>
                        <td class="endpoint-description">The log file id, received from the paste endpoint or from a URL (<?=$urls['baseUrl']?>/[id]).</td>
                    </tr>
                </table>

                <h3>Success <span class="content-type">application/json</span></h3>
                <pre class="answer">
{
  "id": "name/type",
  "name": "Software name, e.g. Vanilla",
  "type": "Type name, e.g. Server Log",
  "version": "Version, e.g. 1.12.2",
  "title": "Combined title, e.g. Vanilla 1.12.2 Server Log",
  "analysis": {
    "problems": [
      {
        "message": "A message explaining the problem.",
        "counter": 1,
        "entry": {
          "level": 6,
          "time": null,
          "prefix": "The prefix of this entry, usually the part containing time and loglevel.",
          "lines": [
            {
              "number": 1,
              "content": "The full content of the line."
            }
          ]
        },
        "solutions": [
          {
            "message": "A message explaining a possible solution."
          }
        ]
      }
    ],
    "information": [
      {
        "message": "Label: value",
        "counter": 1,
        "label": "The label of this information, e.g. Minecraft version",
        "value": "The value of this information, e.g. 1.12.2",
        "entry": {
          "level": 6,
          "time": null,
          "prefix": "The prefix of this entry, usually the part containing time and loglevel.",
          "lines": [
            {
              "number": 6,
              "content": "The full content of the line."
            }
          ]
        }
      }
    ]
  }
}</pre>
                <h3>Chyba <span class="content-type">application/json</span></h3>
                <pre class="answer">
{
    "success": false,
    "error": "Log not found."
}</pre>
            </div>
        </div>
        <div class="row dark api-notes docs">
            <div class="row-inner">
                <div class="docs-text">
                <h2>Poznámky</h2>
            Rozhraní API má v současné době limit rychlosti 60 požadavků za minutu na jednu IP adresu. Tento limit je
            nastaven tak, aby bylo zajištěno, že provozuschopnost této služby. Pokud máte nějaký případ použití, který
            vyžaduje vyšší limit, neváhejte nás kontaktovat.
            <div class="notes-buttons">
                <a class="btn btn-small btn-no-margin btn-blue" href="https://discord.mcnavody.eu">
                    <i class="fa fa-envelope"></i> Kontaktujte nás
                </a>
            </div>
                </div>
                <div class="docs-icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
            </div>
        </div>
<div class="row footer">
    <div class="row-inner">
        MC Návody <?= date("Y"); ?>
    </div>
</div>
    </body>
</html>
