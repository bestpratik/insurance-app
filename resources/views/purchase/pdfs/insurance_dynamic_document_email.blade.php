
<html>
<head>
    <title>{{ $data['templateTitle'] }}</title>
</head> 
<body> 
   
    @php
        //$grossPremium = (float) $data['templatebodyValue'][9];
        $insurancePremiumTax = (float) $data['templatebodyValue'][8];
        //$payableAmount = $grossPremium + $insurancePremiumTax;
 
    $placeholders = [
        '%InsuranceName%' => $data['templatebodyValue'][0] ?? '',
        '%policyNo%' => $data['templatebodyValue'][1] ?? '',
        '%policyHolderAddress1%' => $data['templatebodyValue'][2] ?? '',
        '%policyStartdate%' => $data['templatebodyValue'][3] ?? '',
        '%policyEnddate%' => $data['templatebodyValue'][4] ?? '',
        '%purchaseDate%' => $data['templatebodyValue'][5] ?? '',
        '%policyTerm%' => $data['templatebodyValue'][6] ?? '',
        '%netAnnualpremium%' => $data['templatebodyValue'][7] ?? '',
        '%grossPremium%' => (float) $data['templatebodyValue'][9] ?? '',
        '%insurancePremiumtax%' => number_format($insurancePremiumTax, 2) ?? '', 
        '%rentAmount%' => $data['templatebodyValue'][10] ?? '',
        '%payableAmount%' => $data['templatebodyValue'][11] ?? '',
        '%riskAddress%' => $data['templatebodyValue'][12] ?? '',
        '%insurerTitle%' => $data['templatebodyValue'][13] ?? '',
        '%detailsofCover%' => $data['templatebodyValue'][14] ?? '', 
    ];
 
    $output_string = str_replace(array_keys($placeholders), array_values($placeholders), $data['templateBody']);
   //dd($output_string);
@endphp

    {!! $output_string !!}
</body>
</html>