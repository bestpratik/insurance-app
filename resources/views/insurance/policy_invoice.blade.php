<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Invoice Email</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f4f4f4;
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
      background-color: #f8f8f8;
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
        <div>Invoice No: <strong>MW-H25-0023JUL</strong></div>
        <div>Invoice Date: <strong>23rd May 2025</strong></div>
      </div>
    </div>
    <table>
      <tr>
        <td>
          <p><strong>FAO:</strong> Birmingham City Council<br>
       <strong>Address:</strong> Birmingham City Council</p>
        </td>
      </tr>
  <tr>
    <td colspan="2"><strong>Policy Information</strong></td>
  </tr>
  <tr>
    <td class="left">


      <p><span class="label">Policy Number:</span> LR30005601– BD ELITE</p>
      <p>13812978 - ADVANCED</p>
      <p><span class="label">Insurance:</span> Rent Guarantee and Legal + Contents (Malicious Damage)</p>
      <p><span class="label">Landlord:</span><br>
         TEATHER PROPERTY INVESTMENTS LIMITED</p>
      <p><span class="label">Property Addresses:</span><br>
         103 Fernley Road, Birmingham, B11 3NL</p>
    </td>
    <td class="right">
      <p><span class="label">Policy Start Date:</span> 23rd May 2025</p>
      <p><span class="label">Policy End Date:</span> 22nd May 2026</p>
      <p><span class="label">Unit Price:</span> <span class="orange">£ 718</span></p>
      <p><span class="label">Payment Status:</span> <span class="red">Unpaid</span></p>
    </td>
  </tr>
</table>


    <div class="box">
      <strong>Payment Instructions:</strong>
      <p>Please make the payment of £718 to the account below within 3 days of receiving this email unless a dispute has
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