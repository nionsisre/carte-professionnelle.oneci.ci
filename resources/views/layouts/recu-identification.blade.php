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
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:31px 49px 25px 49px;font-family:'Open Sans',sans-serif;" align="left">
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
                                    <!--<table id="u_content_text_1" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                            <tr>
                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:13px 26px 16px;font-family:'Open Sans',sans-serif;" align="left">
                                                    <div class="v-text-align" style="color: #ffffff; line-height: 140%; text-align: right; word-wrap: break-word;">
                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 10px; line-height: 14px;"><em><span style="line-height: 14px; font-size: 10px;">Cet email est automatis&eacute; - Ne pas r&eacute;pondre &agrave; l'exp&eacute;diteur</span></em></span></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                    </table>-->
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
                                                            <img align="center" border="0" src="data:image/png;base64,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Nc1FIAEIAAAAaFFTEUgAAgAAAFrVTAQSgAAAAICWNRGBBCAAAACgdekjkAAEAAAAkDwCCUAAAAAAb0kbgQQgAAAAgHekjEACEAAAAMDl0kUgAQgAAADgaqkikAAEAAAAsLs0EUgAAgAAALi2FBFIAAIAAADYW/URSAACAAAA2F/VEUgAAgAAAFhNtRFIAAIAAABYXZURSAACAAAAWE91EUgAAgAAAFhfVRFIAAIAAADYTDURSAACAAAA2FwVEUgAAgAAANhO8RFIAAIAAADYXtERSAACAAAA6EexEUgAAgAAAOhPkRFIAAIAAADoV3ERSAACAAAA6F9REUgAAgAAABhGMRFIAAIAAAAYThERSAACAAAAGNbkEUgAAgAAABjepBFIAAIAAAAYx2QRSAACAAAAGM8kEUgAAgAAABjX6BFIAAIAAAAY36gRSAACAAAAmMZoEUgAAgAAAJjOKBFIAAIAAACY1uARSAACAAAAmN6gEUgAAgAAACjDYBFIAAIAAAAoxyARSAACAAAAKEvvEUgAAgAAAChPrxFIAAIAAAAoU28RSAACAAAAKFcvEUgAAgAAACjb1hFIAAIAAAAo31YRSAACAAAAqMPGEUgAAgAAAKjHRhFIAAIAAACoy9oRSAACAAAAqM9aEUgAAgAAAKjTyhFIAAIAAACo10oRSAACAAAAqNu+EUgAAgAAAKjfnhFIAAIAAADI4ZoRSAACAAAAyGPXCCQAAQAAAORyVQQSgAAAAADyuSwCCUAAAAAAOb0dgQ785MM/fdFDBgAAAEjr0yaAAAAAAHK7TwACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABI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AABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEhOAAIAAABITgACAAAASE4AAgAAAEjuwE8+/NMXPWRa9cSDjx/w8AEAoA2zxdz//6VZJoAAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4AAAAAAkhOAAAAAAJITgAAAAACSE4D4/+3dX4yfV53f8a8TK05MTKyYdYXzzxXBdCuEA4vYTtVZLATlIt020FXFHU6RUvWfNgNtpUqtNukNFdLuJDeL4CqWKjVqu2yi7ordbdXaHXVHrWgSo0rVJkgbE8J26VLZBNKEZZnqJM8k4/HYnj+/P8/zeV4vybJv8Px+5/zInHn7POcAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwu03wYzZa8uHHvIBAACAsbjPTDNadgABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAAhBOAAAAAAMIJQAAAAADhBCAAAACAcAIQAAAAQDgBCAAAACCcAAQAAAAQTgACAAAACCcAAQAAAIQTgAAAAADCCUAAAAAA4QQgAAAAgHACEAAAAEA4AQgAAAAgnAAEAAAAEE4AAgAAAAgnAAEAAACEE4AAAAAAwglAAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBuvwlmzG5eeuWrPgAAADASy4tfMdWMlR1AAAAAAOEEIAAAAIBwAhAAAABAOAEIAAAAIJwABAAAABBOAAIAAAAIJwABAAAA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" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 5%;max-width: 58px;" width="58" class="v-src-width v-src-max-width"/>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;"><strong><span style="line-height: 25.2px; font-size: 18px;">Fiche d'identification pour abonné mobile</span></strong></span></p>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:2px 40px 25px;font-family:'Open Sans',sans-serif;" align="left">
                                                <center><img src="{{ $qrcode }}" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 100.44px;"/></center>
                                                <center><!--<div class="qrcode-number"></div><br/>--><b>Numéro de dossier : {{ $numero_dossier }}</b></center>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">Numéro(s) à identifier</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;">
                                                        @foreach($msisdn_list as $msisdn)
                                                        <strong><span style="font-size: 14px; line-height: 19.6px;">{{ $msisdn }}</span></strong>
                                                        @endforeach
                                                    </p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Nom complet</span></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $nom_complet }}</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Date et lieu de naissance</span></p>
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
                                                        <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $date_et_lieu_de_naissance }}</span></strong></p>
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
                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Lieu de résidence</span></p>
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
                                                        <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $lieu_de_residence }}</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Nationalité</span></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $nationalite }}</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Profession</span></p>
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
                                                        <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $profession }}</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $email }}</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">Document justificatif</span></strong></p>
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
                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="font-size: 14px; line-height: 19.6px;">{{ $document_justificatif }}</span></strong></p>
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
        /*$(".qrcode-number").qrcode({
            size: 70,
            fill: '#000',
            text: '{{ $numero_dossier }}',
            mode: 0,
            fontcolor: '#F1C40F'
        });*/
    </script>
</body>
</html>
