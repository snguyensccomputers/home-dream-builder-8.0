<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Home Dream Builder Application Results</title>
    <style>
        .table-container table, .table-container th, .table-container td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table align="center" width="800" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left">
                                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
                                        <tr>
                                            <td colspan="2">
                                                <div style='text-align:center'>
                                                    <a href="{{ asset('/') }}">
                                                        <img src="" alt="Home Dream Builder" />
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="table-container">
                                                    <table cellspacing="0" cellpadding="5" style="margin-left:auto;margin-right:auto;width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="2" style="text-align:center;font-size:18px;background-color:black;color:white">User Information</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>{{ $user['firstname'] }} {{ $user['lastname'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{ $user['email'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pre-approved for home loan?</td>
                                                            <td>{{ $user['pre-approved-information'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td>{{ $user['phone'] }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <div class="table-container">
                                                    <table cellspacing="0" cellpadding="5" style="margin-left:auto;margin-right:auto">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="3" style="text-align:center;font-size:18px;background-color:black;color:white">Ready to Dream</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:5%"></th>
                                                            <th style="width:50%">Questions</th>
                                                            <th style="width:45%">Value</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1 ?>
                                                        @foreach ($form as $questionTag => $formObj)
                                                            @if ($formObj['answer'] != 'No' && $formObj['answer'] != '')
                                                            <tr>
                                                                <td>{{ $i }})</td>
                                                                <td>{{ $formObj['question'] }}</td>
                                                                <td>{{ $formObj['answer'] }}</td>
                                                            </tr>
                                                            @endif
                                                            <?php $i++; ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                            <td valign="top">
                                                <div class="table-container">
                                                    <table cellspacing="0" cellpadding="5" style="margin-left:auto;margin-right:auto">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="3" style="text-align:center;font-size:18px;background-color:black;color:white">Top 10</th>
                                                        </tr>
                                                        <tr>
                                                            <th style='width:10%'></th>
                                                            <th style="width:70%">Features</th>
                                                            <th style="width:20%"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @for ($i = 10; $i > 0; $i--)
                                                            <tr>
                                                                <td>{{ $i }})</td>
                                                                <td>{{ ((10 - $i < count(explode('<>', $top10features))) ? explode('<>', $top10features)[10 - $i] : '') }}</td>
                                                                <td><a href="{{ asset('/ready-to-dream/pros-cons-life-hacks/' . ((10 - $i < count(explode(',', $top10featuresTags))) ? explode(',', $top10featuresTags)[10 - $i] : '')) }}">More Thoughts</a></td>
                                                            </tr>
                                                        @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <tbody class="mcnTextBlockOuter">
                            <tr>
                                <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                    <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                        <tr>
                                            <td valign="top" width="600" style="width:600px;">
                                                <br/>
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                                    <tbody>
                                                    <tr>
                                                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">
                                                            <em>Copyright © 2021 Home Dream Builder, All rights reserved.</em>
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>