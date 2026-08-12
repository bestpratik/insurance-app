<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policy Documents</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: Arial, Helvetica, sans-serif; color: #263238;">
    <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="background-color: #f4f6f8;">
        <tr>
            <td align="center" style="padding: 32px 16px;">
                <table width="600" cellspacing="0" cellpadding="0" border="0" role="presentation" style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 6px; overflow: hidden;">
                    <tr>
                        <td style="padding: 24px 32px; border-bottom: 4px solid #ED2939;">
                            <img src="https://insurance.moneywiseplc.co.uk/logo.jpg" alt="Moneywise Investments PLC" width="180" style="display: block; width: 180px; max-width: 100%; height: auto; border: 0;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px;">
                            {{-- <h1 style="margin: 0 0 18px; font-size: 24px; line-height: 32px; font-weight: 700; color: #1e2b3e;">Your policy documents</h1> --}}

                            <p style="margin: 0 0 16px; font-size: 16px; line-height: 24px;">Dear Client,</p>

                            <p style="margin: 0 0 24px; font-size: 16px; line-height: 24px;">Please review the policy documents attached to this email. You can also view your policy documents securely using the links below.</p>

                            @if($purchase->insurance && $purchase->insurance->dynamicdocument->isNotEmpty())
                                <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="margin: 0 0 24px;">
                                    <tr>
                                        <td style="padding: 18px 20px; background-color: #f8f9fa; border-left: 4px solid #ED2939;">
                                            <p style="margin: 0 0 14px; font-size: 16px; line-height: 22px; font-weight: 700; color: #1e2b3e;">View policy documents</p>

                                            @foreach($purchase->insurance->dynamicdocument as $document)
                                                <table cellspacing="0" cellpadding="0" border="0" role="presentation" style="margin: 0 0 10px;">
                                                    <tr>
                                                        <td align="center" bgcolor="#ED2939" style="border-radius: 3px;">
                                                            <a href="{{ route('insurance.document.download', ['purchase_id' => $purchase->id, 'document_id' => $document->id]) }}" target="_blank" style="display: inline-block; padding: 10px 16px; border: 1px solid #ED2939; border-radius: 3px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18px; font-weight: 700; color: #ffffff; text-decoration: none;">
                                                                {{ $document->title }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <p style="margin: 0; font-size: 16px; line-height: 24px;">Kind regards,<br><strong>Moneywise Investments PLC</strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 32px; background-color: #1e2b3e; color: #ffffff;">
                            <p style="margin: 0 0 6px; font-size: 13px; line-height: 19px; font-weight: 700;">Moneywise Investments PLC</p>
                            <p style="margin: 0; font-size: 12px; line-height: 18px; color: #d7dde5;">This is an automated email. Please do not reply directly to this message.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
