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
       @php
        $placeholders = [
            '%InsuranceName%' => $bodyValue[0],
            '%policyNo%' => $bodyValue[1],
            '%policyHolderAddress1%' => $bodyValue[2],
            '%policyStartdate%' => $bodyValue[3],
            '%policyEnddate%' => $bodyValue[4],
            '%purchaseDate%' => $bodyValue[5],
            '%policyTerm%' => $bodyValue[6],
            '%netAnnualpremium%' => $bodyValue[7],
            '%insurancePremiumtax%' => $bodyValue[8],
            '%grossPremium%' => $bodyValue[9],
            '%rentAmount%' => $bodyValue[10],
            '%riskAddress%' => $bodyValue[11],
            '%insurerTitle%' => $bodyValue[12],
            '%detailsofCover%' => $bodyValue[13],
        ];

        $output_string = str_replace(array_keys($placeholders), array_values($placeholders), $body);
    @endphp

    {!! $output_string !!}
  	  
  	</div>

</body>

</html>