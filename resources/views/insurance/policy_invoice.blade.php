<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Invoice Email</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      /* background-color: #f4f4f4; */
    }

    .container {
      max-width: 800px;
      margin: auto;
      background: #ffffff;
      border: 1px solid #ddd;
      padding: 20px;
    }

    .header {
      background-color: #1e2b3e;
      color: #ffffff;
      padding: 20px;
      position: relative;
    }

    .header img {
      height: 40px;
    }

    .header-right {
      position: absolute;
      right: 20px;
      top: 20px;
      text-align: right;
    }

    .section {
      padding: 20px 0;
    }

    .section strong {
      display: inline-block;
      width: 150px;
    }

    .invoice-info {
      margin-bottom: 20px;
    }

    .highlight {
      color: #f26522;
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    td {
      vertical-align: top;
      padding: 8px 10px;
    }
    .left {
      width: 60%;
    }
    .right {
      width: 40%;
    }
    .label {
      font-weight: bold;
    }
    .orange {
      color: #f26522;
      font-weight: bold;
    }
    .red {
      color: red;
      font-weight: bold;
    }

    .unpaid {
      color: red;
      font-weight: bold;
    }

    .box {
      /* background-color: #f8f8f8; */
      padding: 15px;
      border: 1px solid #ddd;
    }

    .footer {
      text-align: center;
      font-size: 13px;
      margin-top: 40px;
      color: #555;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="header">
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents( "http://insurance.moneywiseplc.co.uk/logo.jpg" )) }}" alt="Moneywise Logo" style="max-width: 180px; margin: 0 auto;">
      <div class="header-right">
        <div>Invoice No: <strong>{{$purchase->invoice->invoice_no ?? ''}}</strong></div>
        <div>Invoice Date: <strong>{{ \Carbon\Carbon::parse($purchase->invoice->invoice_date)->format('d M Y') }}</strong></div>
      </div>
    </div>
    <table>
      <tr>
        <td>
          <p><strong>FAO:</strong>{{$purchase->invoice->billing_name ?? ''}}</p>
           <p><strong>Email:</strong>{{$purchase->invoice->billing_email ?? ''}}<br>
       <strong>Address:</strong>
        {{$purchase->invoice->billing_address_one}} 
         @if(!empty($purchase->invoice->billing_address_two))
           , {{$purchase->invoice->billing_address_two}}
         @endif
    </p>
        </td>
      </tr>
  <tr>
    <td colspan="2"><strong>Policy Information</strong></td>
  </tr>
  <tr>
    <td class="left">


      <p><span class="label">Policy Number:</span>{{$purchase->policy_no ?? ''}}</p>
     
      <p><span class="label">Insurance:</span>{{$purchase->insurance->name ?? ''}} </p>
      <p><span class="label">Landlord:</span><br>
            @if($purchase->policy_holder_type == 'Company')
                {{ $purchase->company_name ?? ''}}
            @elseif($purchase->policy_holder_type == 'Individual')
                {{ $purchase->policy_holder_title ?? '' }} {{ $purchase->policy_holder_fname ?? '' }} {{ $purchase->policy_holder_lname ?? '' }}
            @else
                {{ $purchase->company_name ?? ''}} <br>
                {{ $purchase->policy_holder_title ?? ''}} {{ $purchase->policy_holder_fname ?? ''}} {{ $purchase->policy_holder_lname ?? ''}}
            @endif
      </p>
      <p><span class="label">Property Addresses:</span><br>
         {{$purchase->door_no}}, {{$purchase->address_one}} 
         @if(!empty($purchase->address_two && $purchase->address_three))
           , {{$purchase->address_two}}, {{$purchase->address_three}}

        @elseif(!empty($purchase->address_two))
            {{$purchase->address_two}}
        @else
            {{$purchase->address_three}}
         @endif
        
    </p>
    </td>
    <td class="right">
      <p><span class="label">Policy Start Date:</span>{{ \Carbon\Carbon::parse($purchase->policy_start_date)->format('d M Y') }}</p>
      <p><span class="label">Policy End Date:</span>{{ \Carbon\Carbon::parse($purchase->policy_end_date)->format('d M Y') }}</p>
      <p><span class="label">Unit Price:</span> <span class="orange">£ {{$purchase->insurance->payable_amount ?? ''}} </span></p>
      <p><span class="label">Payment Status:</span> <span class="red">
        @if($purchase->payment_method == 'pay_later')
            Unpaid
        @else
            {{$purchase->payment_method}}
        @endif
      </span></p>
    </td>
  </tr>
</table>


    <div class="box">
      <strong>Payment Instructions:</strong>
      <p>Please make the payment of £{{$purchase->insurance->payable_amount ?? ''}} to the account below within 3 days of receiving this email unless a dispute has
        been raised:</p>
      <p><strong>Account Name:</strong> Moneywise Investments Plc<br>
        <strong>Account Number:</strong> 00789089<br>
        <strong>Sort Code:</strong> 56-00-31
      </p>
    </div>

    <div class="footer">
      <p>Moneywise Investments Plc<br>
        442 Romford Road, London, E7 8DF<br>
        Company Registration No: 01358056</p>
    </div>
  </div>

</body>

</html>