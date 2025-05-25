<!DOCTYPE html>
<html lang="en">

<head>
  <title>Static Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffffff;
      font-size: 14px;
    }

    .invoice-container {
     max-width: 800px;
      width: 100%;
      margin: auto;
      background: #fff;
      padding: 12px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #f0f0f0;
      background-color: #233e5e;
      padding: 20px;
      color: white;
    }

    .logo img {
      height: 50px;
    }

    .invoice-info p {
      text-align: right;
      margin: 5px 0;
    }

    .billing-details {
      margin: 30px 0;
    }

    .billing-details p {
      margin: 5px 0;
    }

    


    .terms {
      margin: 20px 0;
    }

    .footer {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
      border-top: 2px solid #f0f0f0;
      padding-top: 20px;
    }

    .footer-left p,
    .footer-right p {
      margin: 5px 0;
    }

    .payment-details {
      width: 100%;
      margin: 20px 0;
      border-collapse: collapse;
    }

    .payment-details th,
    .payment-details td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }

    .company-info {
      margin-top: 40px;
      text-align: center;
    }

    .company-info p {
      margin: 5px 0;
    }

    .contact-info {
      text-align: center;
      margin-top: 40px;
    }

    .contact-info p {
      margin: 5px 0;
      font-size: 14px;
    }

    .payment-instructions {
      background: #f9f9f9;
      border-left: 10px solid #f6771b;
      padding: 15px;
      margin-bottom: 20px;
    }

    .header b {
      color: #dadada;
      font-size: 14px;
    }

    b {
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div>
    {{$doc->title}}
  </div>
</body>

</html>