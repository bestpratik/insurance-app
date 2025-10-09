<!DOCTYPE html>
<html lang="en">
  <head>
    <title>New Registration</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style type="text/css">
    @media only screen and (max-width: 600px) {
      .main {
        width: 320px !important;
      }

      .top-image {
        width: 100% !important;
      }

      .inside-footer {
        width: 320px !important;
      }

      table[class="contenttable"] {
        width: 320px !important;
        text-align: left !important;
      }

      td[class="force-col"] {
        display: block !important;
      }

      td[class="rm-col"] {
        display: none !important;
      }

      .mt {
        margin-top: 15px !important;
      }

      *[class].width300 {
        width: 255px !important;
      }

      *[class].block {
        display: block !important;
      }

      *[class].blockcol {
        display: none !important;
      }

      .emailButton {
        width: 100% !important;
      }

      .emailButton a {
        display: block !important;
        font-size: 18px !important;
      }
    }
  </style>
  <body link="#1d7de1" vlink="#1d7de1" alink="#1d7de1">
    <table class=" main contenttable" align="center" style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
      <tr>
        <td class="border" style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
          <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
            <tr>
              <td colspan="4" valign="top" class="image-section" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid #1d7de1">
                <a href="#!">
                  <img class="top-image" src="https://insurance.moneywiseplc.co.uk/logo.jpg"  alt="Moneywise Investments Plc" style="width:200px; float: right; padding-right: 10px;">
                </a>
              </td>
            </tr>
            <tr>
              <td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
                <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                  <tr>
                    <td class="head-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 28px;line-height: 34px;font-weight: bold; text-align: center;">
                    <div class="mktEditable" id="main_title">
                      New Insurance Referral - Verification and Processing Required !
                    </div>
                  </td>
                  </tr>
                  <tr>
                  <td class="sub-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 18px;line-height: 29px;font-weight: bold;text-align: center;">
                  <div class="mktEditable" id="intro_title">
                  </div></td>
                </tr>
                <tr>
                  <td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"></td>
                </tr>
                  <tr>
                    <td class="grey-block" style="border-collapse: collapse;border: 0;margin: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff; text-align:center;">
                      <div class="mktEditable" id="cta">
                      <img class="top-image" src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" width="560"/><br><br>
                    </div>
                    </td>
                  </tr>
                  <tr></tr>
                  <tr></tr>
                  <tr>
                    <td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
                      <hr size="1" color="#eeeff0">
                    </td>
                  </tr>
                  <tr>
                    <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                      <div class="mktEditable" id="main_text">
                        <p>Dear Admin Team,</p><br>
                        <p>We have received a new insurance referral on the Moneywise Investments Plc that requires your attention.<br>
                        <p>Please verify the details provided and proceed with the necessary processing steps.</p><br>
                        
                        <p>Here are the referral details:</p>
                        <p>Referrer Name: {{$referral->referral_name}}</p>
                        <p>Referrer Email: {{$referral->referral_email}}</p>
                        <p>Referral Date: {{ now()->format('jS M Y') }}</p>
                        <p>Property Address: {{ implode(', ', array_filter([
                                                    $referral->door_no,
                                                    $referral->address_one,
                                                    $referral->address_two ?: null,
                                                    $referral->address_three ?: null,
                                                    $referral->post_code
                                                ])) }}

                        </p>

                        <p>Rent Amount (£): {{$referral->rent_amount}}</p>
                        <p>Landlord/Agent Name: 
                            @if($referral->policy_holder_type === 'Individual')
                                {{ $referral->policy_holder_title }} {{ $referral->policy_holder_fname }} {{ $referral->policy_holder_lname }}
                            @elseif($referral->policy_holder_type === 'Company')
                                {{ $referral->contact_person_name }}
                            @else
                                {{ $referral->policy_holder_title }} {{ $referral->policy_holder_fname }} {{ $referral->policy_holder_lname }}
                            @endif
                        </p>
                        <p>Landlord/Agent Email: {{$referral->policy_holder_email}}</p>
                        <p>Insurance Name: {{$referral->insurance->name}}</p>
                        @if($referral->tenant_name)
                        <p>Tenant Name: {{$referral->tenant_name}}</p>
                        @endif
                        @php use Carbon\Carbon; @endphp
                        <p>AST Start Date: {{ $referral->ast_start_date ? Carbon::parse($referral->ast_start_date)->format('jS M Y') : 'N/A' }} </p><br>

                        <!-- <p>Or Login to your Moneywise Investments Plc account & click on Referred policy on left hand navigation.</p><br> -->

                        <p>Please ensure that all information is accurate and complete before proceeding. If there are any discrepancies or additional information required, kindly reach out to the referrer directly.</p><br>

                        <p>Your prompt attention to this referral is appreciated. Thank you for your continued dedication and support.</p><br>

                        <p>Best regards,</p><br>

                        <p>Moneywise Investments Plc Team</p><br>

                        <p>This is an automated system generated email, please don't reply.</p><br>

                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;"> &nbsp; <br>
                    </td>
                  </tr>
                  <tr></tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:20px; font-family: Arial, sans-serif; -webkit-text-size-adjust: none;" align="center">
                <table>
                  <tr></tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px; padding: 20px;">
                <div class="mktEditable" id="cta_try">
                  <table border="0" cellpadding="0" cellspacing="0" class="mobile" style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                    <tr>
                      <td class="force-col" valign="top" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                        <table class="mb mt" style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;margin-bottom: 15px;margin-top: 0;">
                          <tr></tr>
                        </table>
                      </td>
                      <td class="rm-col" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;padding-right: 15px;"></td>
                      <td class="force-col" valign="top" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                        <table class="mb mt" style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;margin-bottom: 15px;margin-top: 0;">
                          <tr></tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
            <tr>
              <td valign="top" align="center" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                  <tr>
                    <td valign="top" align="center" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
              <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td align="center" valign="middle" class="social" style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;">
                    <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td align="center" valign="middle" class="social" style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;">
                    <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                      <tr>
                  
                          
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
                  </td>
                </tr>
              </table>
            </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr bgcolor="#fff" style="border-top: 4px solid #1d7de1;">
              <td valign="top" class="footer" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;">
                <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                  <tr>
                    <td class="inside-footer" align="center" valign="middle" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;">
                      <div id="address" class="mktEditable">
                        <b>Moneywise Investments Plc</b>
                       
                        
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>