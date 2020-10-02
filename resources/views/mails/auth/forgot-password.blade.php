<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0;">
<table style="background-color: #F1F1F1; font-family: 'Quicksand', sans-serif; font-weight: 400;" border="0"
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
                    <td width="100%" height="170px"
                        style='background-image: url("{{asset('/img/layout/email-header-1.png')}}")'>
                        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left" style="display: inline-block;">
                                    <img style="width: 101px; height:101px ;margin-left: 35px;"
                                         src="{{asset('img/email/tree-logo.png')}}" alt=""/>

                                </td>
                                <td align="left" style="display: inline-block;">
                                    <p
                                        style="font-size: 36px; color: #ffffff; line-height: 1.2; margin-left: -10px;">
                                        {{__('distributors-mail.reminder.tree')}}<br/>
                                        {{__('distributors-mail.reminder.challenge')}}
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
                                    {{__('auth.reset_password')}}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="13">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font: Regular 20px/29px Source Sans Pro;
                                        letter-spacing: 0;
                                        color: #516977;">
                                    {{$hello}} <br><br>
                                    <a href="{{$url}}" target="_blank" rel="noopener noreferrer"
                                       style="font: Bold 18px/23px Source Sans Pro; display: inline-block; background-color:#6CBE03; width:150px; line-height: 50px; letter-spacing: 0;  font-family: 'Quicksand', sans-serif; color:#ffffff;text-transform: capitalize; text-align: center; text-decoration: none;">
                                        {{__('auth.reset_password')}}
                                    </a>
                                    <br>
                                    <br>
                                    {{$expiration}}
                                    <br>
                                    {{$further_action}}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="16">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="53">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #323F4C;">
                        <img style="width: 164px; height:42px; margin-top: 14px; margin-bottom: 14px;"
                             src="{{asset('img/email/logo.png')}}" alt=""/>
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
