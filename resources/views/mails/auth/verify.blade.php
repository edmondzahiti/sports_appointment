<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ __('mail.verify.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0;">
<table style="background-color: #F1F1F1; font-family: 'Source Sans Pro', sans-serif; font-weight: 400;" border="0"
       cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <table style="background-color: #ffffff; " align="center" border="0" cellpadding="0" cellspacing="0"
                   width="600px">
                <tr style="background-color: #F1F1F1">
                    <td style="font-size: 0; line-height: 0;" height="50">&nbsp;
                    </td>
                </tr>
                <tr>
                    <td width="100%" height="170px" style='background: url("{{asset('/img/layout/email-header-1.png')}}") center/cover no-repeat'>
                        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <p style="font-family: 'Titillium Web'; font-size: 50px; font-weight: 600; color: #333333; line-height: 55px; text-align: center; margin: 0 auto;">
                                        {{ config('app.name') }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0; line-height: 0;" height="41">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table
                            style="text-align: center; background-color: #ffffff; max-width: 500px; min-width: 500px; width: 500px; "
                            align="center" border="0" cellpadding="0" cellspacing="0" width="500px">
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="13">&nbsp;</td>
                            </tr>

                            <tr>
                                <td style="font: Bold 30px/38px Source Sans Pro;
                                        letter-spacing: 0;
                                        color: #323F4C;">
                                    {{ __('mail.verify.title') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="13">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font: Regular 20px/29px Source Sans Pro;
                                        letter-spacing: 0;
                                        color: #516977;">
                                        {{ __('mail.verify.paragraph_1', ['application' => config('app.name')]) }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="16">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font: Regular 20px/29px Source Sans Pro;
                                        letter-spacing: 0;
                                        color: #516977;">
                                        {{ __('mail.verify.paragraph_2') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="53">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a href="{{ $verification_url }}" target="_blank" rel="noopener noreferrer"
                                       style="font: Bold 18px/23px Source Sans Pro; display: inline-block; background-color:#17a2b8; width:275px; line-height: 50px; letter-spacing: 0;  font-family: 'Quicksand', sans-serif; color:#ffffff;text-transform: capitalize; text-align: center; text-decoration: none;">
                                        {{ __('mail.verify.button') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="53">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #323F4C;">
                        <img style="width: 164px; height:42px; margin-top: 14px; margin-bottom: 14px;" src="{{asset('img/email/logo.png')}}" alt="" />
                    </td>
                </tr>
                <tr style="background-color: #F1F1F1">
                    <td style="font-size: 0; line-height: 0;" height="40">&nbsp;
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>

</html>
