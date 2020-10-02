
@include('mails.includes.head', ['emailTitle' => __('mail.additional_info.title')])

<table style="background-color: #ffffff; " align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" width="600px">
    <tr style="background-color: #F1F1F1">
        <td style="font-size: 0; line-height: 0;" height="50">&nbsp;
        </td>
    </tr>

    <tr>
        <td style="font-size: 0; line-height: 0;" height="40">&nbsp;</td>
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
                    <td style="font-family: 'Source Sans Pro'; font-size: 30px; line-height: 38px; font-weight: 700;
                            letter-spacing: 0;
                            color: #323F4C;">
                        Welcome to Sports Appointment Platform
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0; line-height: 0;" height="13">&nbsp;</td>
                </tr>
                {{--
                <tr>
                    <td style="font: Regular 20px/29px Source Sans Pro; letter-spacing: 0; color: #333333;">
                        {{ __('mail.greeting') }} {{ $user->name }}&nbsp;{{ $user->surname }}
                    </td>
                </tr>
                --}}
                <tr>
                    <td style="font-size: 0; line-height: 0;" height="16">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-family: 'Source Sans Pro'; font-size: 20px; line-height: 29px; font-weight: 400; letter-spacing: 0; color: #333333;">
                        Hello {{$user->name}}!
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0; line-height: 0;" height="55">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-family: 'Source Sans Pro'; font-size: 20px; line-height: 29px; font-weight: 400;
                            letter-spacing: 0;
                            color: #333333;">
                        Your account has been registered by Sports Appointment Platform Management, now you can login by clicking the bottom below<br>
                        email: {{$user->email}}<br>
                        password: {{$user->name.$user->created_at->format('h:s').$user->surname.$user->created_at->format('i')}}<br>
                    </td>
                </tr>

                <tr>
                    <td style="font-size: 0; line-height: 0;" height="55">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="{{ route('login')}}" target="_blank" rel="noopener noreferrer"
                           style="font: Bold 18px/23px Source Sans Pro; display: inline-block; background-color:#55BDBD; width:275px; line-height: 50px; letter-spacing: 0;  font-family: 'Source Sans Pro', sans-serif; color:#ffffff;text-transform: capitalize; text-align: center; text-decoration: none;border-radius: 2px;">
                            Login
                        </a>
                    </td>
                </tr>
                <br>
                <tr>
                    <td align="center">
                        Note: you can change your infos after access the page
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0; line-height: 0;" height="55">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td style="font-size: 0; line-height: 0;" height="40">&nbsp;</td>
    </tr>

    @include('mails.includes.footer', ['emailFooterLogo' => asset('/img/general/logo-big.png')])

    <tr style="background-color: #F1F1F1">
        <td style="font-size: 0; line-height: 0;" height="40">&nbsp;
        </td>
    </tr>
</table>

@include('mails.includes.tail')
