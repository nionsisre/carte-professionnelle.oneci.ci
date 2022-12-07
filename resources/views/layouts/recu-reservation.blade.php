<!DOCTYPE HTML>
<!--[if IE 8]>
<html class="ie8 no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--<![endif]-->
<head>
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
    <!-- Begin All size Favicons for all pages -->
    <link href="{{ URL::asset('assets/images/favicons/favicon.ico') }}" type="image/x-icon" rel="shortcut icon">
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-57x57.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-114x114.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-72x72.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-60x60.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-120x120.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-76x76.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-152x152.png') }}"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-196x196.png') }}"
          sizes="196x196"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-96x96.png') }}"
          sizes="96x96"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-32x32.png') }}"
          sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-16x16.png') }}"
          sizes="16x16"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-128.png') }}"
          sizes="128x128"/>
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="{{ URL::asset('assets/images/favicons/mstile-144x144.png') }}"/>
    <meta name="msapplication-square70x70logo" content="{{ URL::asset('assets/images/favicons/mstile-70x70.png') }}"/>
    <meta name="msapplication-square150x150logo" content="{{ URL::asset('assets/images/favicons/mstile-150x150.png') }}"/>
    <meta name="msapplication-wide310x150logo" content="{{ URL::asset('assets/images/favicons/mstile-310x150.png') }}"/>
    <meta name="msapplication-square310x310logo" content="{{ URL::asset('assets/images/favicons/mstile-310x310.png') }}"/>
    <!-- End All size Favicons for all pages -->
    <title>ONECI | {{ $title }} </title>
    <style type="text/css">
        table, td {
            color: #000000;
        }
        a {
            color: #6d6d6d;
            text-decoration: none;
        }
        @media (max-width: 480px) {
            #u_content_image_1 .v-src-width {
                width: auto !important;
            }
            #u_content_image_1 .v-src-max-width {
                max-width: 50% !important;
            }
            #u_content_text_1 .v-text-align {
                text-align: center !important;
            }
            #u_content_text_14 .v-text-align {
                text-align: center !important;
            }
            #u_content_text_15 .v-text-align {
                text-align: center !important;
            }
        }
        @media only screen and (min-width: 620px) {
            .u-row {
                width: 600px !important;
            }
            .u-row .u-col {
                vertical-align: top;
            }
            .u-row .u-col-33p33 {
                width: 199.98px !important;
            }
            .u-row .u-col-50 {
                width: 300px !important;
            }
            .u-row .u-col-66p67 {
                width: 400.02px !important;
            }
            .u-row .u-col-100 {
                width: 600px !important;
            }
        }
        @media (max-width: 620px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
            .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }
            .u-row {
                width: calc(100% - 40px) !important;
            }
            .u-col {
                width: 100% !important;
            }
            .u-col > div {
                margin: 0 auto;
            }
            .no-stack .u-col {
                min-width: 0 !important;
                display: table-cell !important;
            }
            .no-stack .u-col-50 {
                width: 50% !important;
            }
        }
        body {
            margin: 0;
            padding: 0;
        }
        table, tr, td {
            vertical-align: top;
            border-collapse: collapse;
        }
        p {
            margin: 0;
        }
        .ie-container table,
        .mso-container table {
            table-layout: fixed;
        }
        * {
            line-height: inherit;
        }
        a[x-apple-data-detectors='true'] {
            color: inherit !important;
            text-decoration: none !important;
        }
        @media (max-width: 480px) {
            .hide-mobile {
                display: none !important;
                max-height: 0px;
                overflow: hidden;
            }
        }
    </style>
</head>
<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #eeeeee;color: #000000">
    <!--[if IE]><div class="ie-container"><![endif]-->
    <!--[if mso]><div class="mso-container"><![endif]-->
    <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #eeeeee;width:100%" cellpadding="0" cellspacing="0">
        <tbody>
        <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #eeeeee;"><![endif]-->
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #6d6d6d;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ba372a;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="200" style="width: 200px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-33p33" style="max-width: 320px;min-width: 200px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table id="u_content_image_1" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:31px 49px 25px 0px;font-family:'Open Sans',sans-serif;" align="left">
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td class="v-text-align" style="padding-right: 0px;padding-left: 0px;" align="center">
                                                            <img align="center" border="0" src="data:image/png;base64, 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" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 66.44px;" width="66.44" class="v-src-width v-src-max-width"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="400" style="width: 400px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-66p67" style="max-width: 320px;min-width: 400px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table class="hide-mobile" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">
                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table id="u_content_text_1" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:13px 26px 16px;font-family:'Open Sans',sans-serif;" align="left">
                                                <div class="v-text-align" style="color: #ffffff; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 10px; line-height: 14px;"><em><span style="line-height: 14px; font-size: 10px;">Cet email est automatis&eacute; - Ne pas r&eacute;pondre &agrave; l'exp&eacute;diteur</span></em></span></p>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:40px 10px 10px;font-family:'Open Sans',sans-serif;" align="left">
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td class="v-text-align" style="padding-right: 0px;padding-left: 0px;" align="center">
                                                            <img align="center" border="0" src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAE4AAABOCAYAAACOqiAdAAAACXBIWXMAAC4jAAAuIwF4pT92AAARE2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDggNzkuMTY0MDM2LCAyMDE5LzA4LzEzLTAxOjA2OjU3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOmlsbHVzdHJhdG9yPSJodHRwOi8vbnMuYWRvYmUuY29tL2lsbHVzdHJhdG9yLzEuMC8iIHhtbG5zOmxyPSJodHRwOi8vbnMuYWRvYmUuY29tL2xpZ2h0cm9vbS8xLjAvIiB4bWxuczpwZGY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGRmLzEuMy8iIHhtbG5zOnBkZng9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGRmeC8xLjMvIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiBkYzpmb3JtYXQ9ImltYWdlL3BuZyIgaWxsdXN0cmF0b3I6U3RhcnR1cFByb2ZpbGU9IldlYiIgcGRmOlByb2R1Y2VyPSJBZG9iZSBQREYgbGlicmFyeSAxNS4wMCIgcGRmeDpDcmVhdG9yVmVyc2lvbj0iMjEuMC4wIiB4bXA6Q3JlYXRlRGF0ZT0iMjAxNy0xMC0wOVQxNjoyMToxMSswNzowMCIgeG1wOkNyZWF0b3JUb29sPSJyYXdwaXhlbCBsdGQuIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIxLTA2LTA5VDE2OjExOjE4WiIgeG1wOk1vZGlmeURhdGU9IjIwMjEtMDYtMDlUMTY6MTE6MThaIiB4bXA6UmF0aW5nPSIwIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6YjdiNmQ0NGYtN2NiYS1hMTQxLWI3ODgtZGEzZWFjMDM0M2I4IiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjVhZWE1NTE3LTY4N2YtNjk0YS1iZDk2LWZlMDJlZDdiOWQxZiIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ1dWlkOjY1RTYzOTA2ODZDRjExREJBNkUyRDg4N0NFQUNCNDA3IiB4bXBNTTpSZW5kaXRpb25DbGFzcz0icHJvb2Y6cGRmIiBwaG90b3Nob3A6TGVnYWN5SVBUQ0RpZ2VzdD0iQUZDOTBBOTJDMzlCMDBBOEUxMTNBNzIzMDQzRDM4OEEiIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSI+IDxkYzp0aXRsZT4gPHJkZjpBbHQ+IDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+SWNvbnMtNjItMDE8L3JkZjpsaT4gPC9yZGY6QWx0PiA8L2RjOnRpdGxlPiA8ZGM6c3ViamVjdD4gPHJkZjpCYWc+IDxyZGY6bGk+YWdlbmRhPC9yZGY6bGk+IDxyZGY6bGk+YXBwb2ludG1lbnQ8L3JkZjpsaT4gPHJkZjpsaT5hcnQ8L3JkZjpsaT4gPHJkZjpsaT5jYWxlbmRhcjwvcmRmOmxpPiA8cmRmOmxpPmRhdGU8L3JkZjpsaT4gPHJkZjpsaT5kYXk8L3JkZjpsaT4gPHJkZjpsaT5kZWFkbGluZTwvcmRmOmxpPiA8cmRmOmxpPmRlY29yYXRpdmU8L3JkZjpsaT4gPHJkZjpsaT5kZXNpZ248L3JkZjpsaT4gPHJkZjpsaT5kb29kbGU8L3JkZjpsaT4gPHJkZjpsaT5lcXVpcG1lbnQ8L3JkZjpsaT4gPHJkZjpsaT5ldmVudDwvcmRmOmxpPiA8cmRmOmxpPmdyYXBoaWM8L3JkZjpsaT4gPHJkZjpsaT5pY29uPC9yZGY6bGk+IDxyZGY6bGk+aWxsdXN0cmF0aW9uPC9yZGY6bGk+IDxyZGY6bGk+aXNvbGF0ZWQ8L3JkZjpsaT4gPHJkZjpsaT5tb250aDwvcmRmOmxpPiA8cmRmOmxpPm9iamVjdDwvcmRmOmxpPiA8cmRmOmxpPm9mZmljZTwvcmRmOmxpPiA8cmRmOmxpPm9yZ2FuaXplcjwvcmRmOmxpPiA8cmRmOmxpPnBsYW5uZXI8L3JkZjpsaT4gPHJkZjpsaT5yZW1pbmRlcjwvcmRmOmxpPiA8cmRmOmxpPnNjaG9vbDwvcmRmOmxpPiA8cmRmOmxpPnNrZXRjaDwvcmRmOmxpPiA8cmRmOmxpPnN0YXRpb25hcnk8L3JkZjpsaT4gPHJkZjpsaT5zdGF0aW9uZXJ5PC9yZGY6bGk+IDxyZGY6bGk+c3ltYm9sPC9yZGY6bGk+IDxyZGY6bGk+dGltZTwvcmRmOmxpPiA8cmRmOmxpPnRvb2xzPC9yZGY6bGk+IDxyZGY6bGk+dXRpbGl0eTwvcmRmOmxpPiA8cmRmOmxpPnZlY3RvcjwvcmRmOmxpPiA8L3JkZjpCYWc+IDwvZGM6c3ViamVjdD4gPGRjOnJpZ2h0cz4gPHJkZjpBbHQ+IDxyZGY6bGkgeG1sOmxhbmc9IngtZGVmYXVsdCI+UmF3cGl4ZWwgTHRkLjwvcmRmOmxpPiA8L3JkZjpBbHQ+IDwvZGM6cmlnaHRzPiA8ZGM6ZGVzY3JpcHRpb24+IDxyZGY6QWx0PiA8cmRmOmxpIHhtbDpsYW5nPSJ4LWRlZmF1bHQiPklsbHVzdHJhdGlvbiBvZiBjYWxlbmRhciBpY29uPC9yZGY6bGk+IDwvcmRmOkFsdD4gPC9kYzpkZXNjcmlwdGlvbj4gPGxyOmhpZXJhcmNoaWNhbFN1YmplY3Q+IDxyZGY6QmFnPiA8cmRmOmxpPk90aGVyIEtleXdvcmRzfCR2ZWN0b3I8L3JkZjpsaT4gPHJkZjpsaT5PdGhlciBLZXl3b3Jkc3wjdnByb2plY3RvbGQxPC9yZGY6bGk+IDxyZGY6bGk+T3RoZXIgS2V5d29yZHN8QHZwcm9qZWN0b2xkMXg8L3JkZjpsaT4gPC9yZGY6QmFnPiA8L2xyOmhpZXJhcmNoaWNhbFN1YmplY3Q+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjJkODYxYjZkLTA1ZGQtYWU0ZC1iNDRlLTEwODdjNjIyM2NhZSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3YWY0OTBlMC01YzdjLTQzMGMtOTI2MS1kMjdhYmMwMDE4Y2QiIHN0UmVmOm9yaWdpbmFsRG9jdW1lbnRJRD0idXVpZDo2NUU2MzkwNjg2Q0YxMURCQTZFMkQ4ODdDRUFDQjQwNyIgc3RSZWY6cmVuZGl0aW9uQ2xhc3M9InByb29mOnBkZiIvPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6Y2hhbmdlZD0iLyIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDphN2Y3YjNjMi1iNTI4LTRhYmItYjQ1Yi00YTM2ZmQ3MTkxOGEiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9InJhd3BpeGVsIGx0ZC4iIHN0RXZ0OndoZW49IjIwMTctMTAtMDRUMTE6MjI6MTMrMDc6MDAiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDpjaGFuZ2VkPSIvIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjdhZjQ5MGUwLTVjN2MtNDMwYy05MjYxLWQyN2FiYzAwMThjZCIgc3RFdnQ6d2hlbj0iMjAxNy0xMC0wOVQxNjoyMToxMSswNzowMCIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0OmNoYW5nZWQ9Ii9tZXRhZGF0YSIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDphZDUxMWFkMS0yYmE3LTQ3NWItYTc3Ni0xM2ZiYWViODE4ZTQiIHN0RXZ0OndoZW49IjIwMTctMTAtMDlUMTg6NTE6MDkrMDc6MDAiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDpjaGFuZ2VkPSIvbWV0YWRhdGEiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6NDMzNDJmNzQtZGVlNy00NDJmLWI1YzYtM2RiOTE2MTdjYTBjIiBzdEV2dDp3aGVuPSIyMDE3LTEwLTA5VDE4OjUxOjA5KzA3OjAwIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDoyZDg2MWI2ZC0wNWRkLWFlNGQtYjQ0ZS0xMDg3YzYyMjNjYWUiIHN0RXZ0OndoZW49IjIwMjEtMDYtMDlUMTY6MTE6MThaIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjEuMCAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBpbWFnZS9qcGVnIHRvIGltYWdlL3BuZyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iZGVyaXZlZCIgc3RFdnQ6cGFyYW1ldGVycz0iY29udmVydGVkIGZyb20gaW1hZ2UvanBlZyB0byBpbWFnZS9wbmciLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjVhZWE1NTE3LTY4N2YtNjk0YS1iZDk2LWZlMDJlZDdiOWQxZiIgc3RFdnQ6d2hlbj0iMjAyMS0wNi0wOVQxNjoxMToxOFoiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMS4wIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz60fWiAAAAL5ElEQVR4nO2b+Y8cx3XHP6+qu+fanT24y5CS1owtR5bsgBFkx4AdI7AhIJEMRHYMy0EEGIaRwwnkH/Mf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" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 10%;max-width: 58px;" width="58" class="v-src-width v-src-max-width"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #47484b; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;"><strong><span style="line-height: 25.2px; font-size: 18px;">Fiche de réservation pour l'enrôlement VIP ONECI</span></strong></span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:2px 40px 25px;font-family:'Open Sans',sans-serif;" align="left">
                                                <div class="v-text-align" style="color: #7a7676; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 170%; text-align: center;"><span style="font-size: 16px; line-height: 27.2px;">
                                                        Madame/Monsieur <b>{{ "XXXXXXXXX" }}</b>, votre rendez-vous pour l'enrôlement VIP du <b>{{ "XXXXXXXXX" }}</b> à <b>{{ "XXXXXXXXX" }}</b> a été confirmé avec succès.<br/>
                                                        Veuillez retrouver ci-dessous votre code de réservation à utiliser le jour du rendez-vous :
                                                    </span></p>
                                                </div>
                                                <center><br/><div class="qrcode-number"></div></center><br/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Open Sans',sans-serif;" align="left">
                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table id="u_content_text_14" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">
                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">Code de réservation</span></strong></p>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table id="u_content_text_15" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ "XXXXXXXXX" }}</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Open Sans',sans-serif;" align="left">

                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row no-stack" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Nom et Pr&eacute;noms</span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ "XXXXXXXXX" }}</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row no-stack" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Num&eacute;ro de t&eacute;l&eacute;phone</span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ "XXXXXXXXX" }}</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row no-stack" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                        <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                            <tr>
                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                    <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Email</span></p>
                                                    </div>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ "XXXXXXXXX" }}</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row no-stack" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Centre VIP</span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;"><strong>{{ "XXXXXXXXX" }}</strong></span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row no-stack" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Date et Heure de rendez-vous</span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;"><strong>{{ "XXXXXXXXX" }}</strong></span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Open Sans',sans-serif;" align="left">

                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row no-stack" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">Tarif total de la prestation VIP</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="300" style="width: 300px;padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px 30px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #615e5e; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ "XXXXXXXXX" }} FCFA</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Open Sans',sans-serif;" align="left">
                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>



                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:14px;font-family:'Open Sans',sans-serif;" align="left">

                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>







                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:2px 40px 15px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #7a7676; line-height: 170%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 170%; text-align: center;"><em><span style="font-size: 14px; line-height: 23.8px;">L'ONECI vous remercie...</span></em></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:9px 9px 31px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div align="center">
                                                    <div style="display: table; max-width:0px;">
                                                        <!--[if (mso)|(IE)]><table width="-1" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:0px;"><tr><![endif]-->
                                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Open Sans',sans-serif;" align="left">

                                                <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <span>&#160;</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #1b5e20;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f78e0c;"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                <div style="width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:16px;font-family:'Open Sans',sans-serif;" align="left">

                                                <div class="v-text-align" style="color: #ecf7ff; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 140%;"><em><span style="font-size: 12px; line-height: 16.8px;"><span style="font-size: 10px; line-height: 14px;">Copyright &copy; {{ date('Y', time()) }} - Office National de l'Etat Civil et de l'Identification (ONECI) - Tous droits reserv&eacute;s.</span>&nbsp;</span></em></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><![endif]-->
                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
        </tr>
        </tbody>
    </table>
    <!--[if mso]></div><![endif]-->
    <!--[if IE]></div><![endif]-->
    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery-3.6.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/jquery-migrate-1.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery-migrate-3.4.0.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery-qrcode.min.js') }}" type="text/javascript"></script>
    <script>
        $(".qrcode-number").qrcode({
            size: 70,
            fill: '#000',
            text: '{{ "XXXXXXXXX" }}',
            mode: 0,
            fontcolor: '#F1C40F'
        });
    </script>
</body>
</html>
