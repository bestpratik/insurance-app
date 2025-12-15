
<html>
<head>
    <title>{{ $data['templateTitle'] }}</title>
</head> 
<body>
   

    <!-- @php
        $placeholders = [
            '%InsuranceName%' => $data['templatebodyValue'][0],
            '%policyNo%' => $data['templatebodyValue'][1],
            '%policyHolderAddress1%' => $data['templatebodyValue'][2],
            '%policyStartdate%' => $data['templatebodyValue'][3],
            '%policyEnddate%' => $data['templatebodyValue'][4],
            '%purchaseDate%' => $data['templatebodyValue'][5],
            '%policyTerm%' => $data['templatebodyValue'][6],
            '%netAnnualpremium%' => $data['templatebodyValue'][7],
            '%insurancePremiumtax%' => $data['templatebodyValue'][8],
            '%grossPremium%' => $data['templatebodyValue'][9],
            '%rentAmount%' => $data['templatebodyValue'][10],
            '%riskAddress%' => $data['templatebodyValue'][11],
            '%insurerTitle%' => $data['templatebodyValue'][12],
            '%detailsofCover%' => $data['templatebodyValue'][13],
        ];

        $output_string = str_replace(array_keys($placeholders), array_values($placeholders), $data['templateBody']);
    @endphp -->


    @php
    $grossPremium = (float) $data['templatebodyValue'][9];
    $insurancePremiumTax = (float) $data['templatebodyValue'][8];
    $payableAmount = $grossPremium + $insurancePremiumTax;

    $placeholders = [
        '%InsuranceName%' => $data['templatebodyValue'][0],
        '%policyNo%' => $data['templatebodyValue'][1],
        '%policyHolderAddress1%' => $data['templatebodyValue'][2],
        '%policyStartdate%' => $data['templatebodyValue'][3],
        '%policyEnddate%' => $data['templatebodyValue'][4],
        '%purchaseDate%' => $data['templatebodyValue'][5],
        '%policyTerm%' => $data['templatebodyValue'][6],
        '%netAnnualpremium%' => $data['templatebodyValue'][7],
        '%insurancePremiumtax%' => number_format($insurancePremiumTax, 2),
        '%grossPremium%' => number_format($grossPremium, 2),
        '%rentAmount%' => $data['templatebodyValue'][10],
        '%payableAmount%' => number_format($payableAmount, 2), // new placeholder
        '%riskAddress%' => $data['templatebodyValue'][11],
        '%insurerTitle%' => $data['templatebodyValue'][12],
        '%detailsofCover%' => $data['templatebodyValue'][13],
    ];

    $output_string = str_replace(array_keys($placeholders), array_values($placeholders), $data['templateBody']);
@endphp

    {!! $output_string !!}
</body>
</html>