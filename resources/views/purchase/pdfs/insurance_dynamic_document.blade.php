
<html>
<head>
    <title>{{ $data['templateTitle'] }}</title>
</head> 
<body>
    {!! $data['templateHeder'] !!} 

    @php
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
        ];

        $output_string = str_replace(array_keys($placeholders), array_values($placeholders), $data['templateBody']);
    @endphp

    {!! $output_string !!}
    
    {!! $data['templateFooter'] !!}
</body>
</html>
