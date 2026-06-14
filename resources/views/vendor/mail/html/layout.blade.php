<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="" style="padding: 50px 0px;" >
        <div class="mx-auto email-container">
            <table role="presentation" class="" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fff;margin:0!important;box-shadow: 1px 1px 15px #ddd;">
                <tr>
                    <td class="logo" style="text-align: center;padding: 30px 30px;">
                        <img src="{{ Helper::assets('assets/images/logo.png') }}" width="150" height="50" alt="{{env('APP_NAME')}}" border="0">
                    </td>
                </tr>
                <tr style="padding-top: 15px;padding-bottom: 15px;">
                    <td><hr style="border: 1px solid #f7f7f7;"></td>
                </tr>
                <tr>
                    <td style="padding: 20px 30px;">
                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                        {{ $subcopy ?? '' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>