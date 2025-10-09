<!DOCTYPE html>
<html>

<head>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e4e4e4;
        }

        .header {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .checkbox-cell {
            text-align: center;
        }

        .section-header {
            background-color: #ec2525ff;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <div style="width: 100%; margin: 0 auto; ">

        <div style="background: #fff;margin: 0 auto;text-align:center">
            <!-- <img style="width: 282px;padding:22px;" src="{{ asset('logo.png') }}"> -->
            @php
            $logoPath = public_path('logo.jpg');
            $base64Logo = 'data:image/jpg;base64,' . base64_encode(file_get_contents($logoPath));
            @endphp

            <img src="{{ $base64Logo }}" alt="Logo" style="max-width: 180px; margin: 0 auto;">

        </div>

        <section style="padding: 0px 2em;">


            <div style="display: inline;">

                <div class="header">Insurance Referral Form</div>
                <table>
                    <tr>
                        <th>Referral Date:</th>
                        <td>
                            {{ \Carbon\Carbon::parse($referral->created_at)->format('jS M Y') }}
                        </td>
                    </tr>

                    <!-- Property Details -->
                    <tr>
                        <th colspan="2" class="section-header">Property Details</th>
                    </tr>
                    <tr>
                        <th>Insurance:</th>
                        <td> {{ $referral->insurance->name }}</td>
                    </tr>
                    <tr>
                        <th>Policy Type:</th>
                        <td> {{ $referral->insurance_type }}</td>
                    </tr>

                    <tr>
                        <th>Rental Property Address:</th>
                        <td> {{ implode(', ', array_filter([
                                                    $referral->door_no,
                                                    $referral->address_one,
                                                    $referral->address_two ?: null,
                                                    $referral->address_three ?: null,
                                                    $referral->post_code
                                                ])) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Post Code:</th>
                        <td> {{ $referral->post_code }}</td>
                    </tr>

                    <tr>
                        <th>No of bedrooms:</th>
                        <td> {{ $referral->no_of_bedroom ?? 'N/A'}}</td>
                    </tr>

                    <tr>
                        <th>LHA Rate (Rent PCM in £):</th>
                        <td> {{ $referral->rent_amount }}</td>
                    </tr>

                    <!-- Tenant Details -->
                    <tr>
                        <th colspan="2" class="section-header">Tenant Details</th>
                    </tr>

                    <tr>
                        <th>Tenant(s) name:</th>
                        <td>{{$referral->tenant_name}}</td>
                    </tr>tenant_phone
                    <tr>
                        <th>Email Address:</th>
                        <td>{{$referral->tenant_email}}</td>
                    </tr>
                    @if($referral->tenant_phone)
                    <tr>
                        <th>Contact No:</th>
                        <td> {{$referral->tenant_phone}}</td>
                    </tr>
                    @endif

                    <tr>
                        <th>Tenancy Term:</th>
                        <td>
                            <!-- {{$referral->policy_term}} -->
                            @if($referral->policy_term == 1)
                            {{ $referral->policy_term .' year' ?? 'N/A' }}
                            @else
                            {{ $referral->policy_term .' years' ?? 'N/A' }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>AST Start Date:</th>
                        <td>{{ \Carbon\Carbon::parse($referral->ast_start_date)->format('jS M Y') }}</td>
                    </tr>

                    <tr>
                        <th>Policy Start Date:</th>
                        <td>{{ \Carbon\Carbon::parse($referral->policy_start_date)->format('jS M Y') }}</td>
                    </tr>

                    <!-- Policy Holder Details -->
                    <tr>
                        <th colspan="2" class="section-header">Policy Holder Details</th>
                    </tr>

                    <tr>
                        <!-- <th>Insurance Type:</th> -->
                         <th>Policy for:</th>
                        <td>{{$referral->product_type ?? 'N/A'}}</td>
                    </tr>

                    <tr>
                        <th>Policy Holder Type:</th>
                        <td>{{$referral->policy_holder_type}}</td>
                    </tr>

                    @if($referral->company_name)
                    <tr>
                        <th>Company/Organization:</th>
                        <td>{{$referral->company_name}}</td>
                    </tr>
                    @endif

                    <tr>
                        <th>Name:</th>
                        <td>
                            @if($referral->policy_holder_type === 'Individual')
                            {{ $referral->policy_holder_title }} {{ $referral->policy_holder_fname }} {{ $referral->policy_holder_lname }}
                            @elseif($referral->policy_holder_type === 'Company')
                            {{ $referral->contact_person_name }}
                            @else
                            {{ $referral->policy_holder_title }} {{ $referral->policy_holder_fname }} {{ $referral->policy_holder_lname }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Landlord/Agent Primary Address:</th>
                        <td>{{ implode(', ', array_filter([
                                                    $referral->policy_holder_address_one,
                                                    $referral->policy_holder_post_code
                                                ])) }}</td>
                    </tr>

                    @if($referral->policy_holder_address_two)
                    <tr>
                        <th>Landlord/Agent Secondary Address:</th>
                        <td>{{ $referral->policy_holder_address_two ?: null }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Postcode:</th>
                        <td>{{$referral->policy_holder_post_code}}</td>
                    </tr>
                    <tr>
                        <th>Contact No:</th>
                        <td> {{$referral->policy_holder_phone}}</td>
                    </tr>

                    @if($referral->policy_holder_alternative_phone)
                    <tr>
                        <th>Alternate Contact No:</th>
                        <td> {{$referral->policy_holder_alternative_phone}}</td>
                    </tr>
                    @endif

                    <tr>
                        <th>Email Address:</th>
                        <td>{{$referral->policy_holder_email}}</td>
                    </tr>

                     <tr>
                        <th colspan="2" class="section-header">Council Details (From which the tenant is from)</th>
                    </tr>

                    <tr>
                        <!-- <th>Insurance Type:</th> -->
                         <th>Council Name:</th>
                        <td>{{$referral->council_name ?? 'N/A'}}</td>
                    </tr>

                    <tr>
                        <th>Council officer Name: </th>
                        <td>{{$referral->council_officer_name}}</td>
                    </tr>

                    <tr>
                        <th>Council_officer_email:</th>
                        <td>{{$referral->council_officer_email}}</td>
                    </tr>

                     <tr>
                        <th>Referral Name: </th>
                        <td>{{$referral->referral_name}}</td>
                    </tr>

                    <tr>
                        <th>Referral Email:</th>
                        <td>{{$referral->referral_email}}</td>
                    </tr>

                    

                    <!-- Billing Details  -->

                    {{-- <tr>
                        <th colspan="2" class="section-header">Billing Details</th>
                    </tr>

                    <tr>
                        <th>Billing Name:</th>
                        <td>{{$referral->invoice->billing_name}}</td>
                    </tr>
                    <tr>
                        <th>Billing Address:</th>
                        <td>{{ implode(', ', array_filter([
                                                    $referral->invoice->billing_address,
                                                    $referral->invoice->billing_city,
                                                    $referral->invoice->billing_postcode
                                                ])) }}</td>
                    </tr>
                    <tr>
                        <th>Billing Email:</th>
                        <td>{{$referral->invoice->billing_email}}</td>
                    </tr>
                    <tr>
                        <th>Billing Contact:</th>
                        <td>{{$referral->invoice->billing_phone}}</td>
                    </tr> --}}
                    <!-- <tr>
                        <th>Contact Person Name:</th>
                        <td>{{$referral->contact_person_name}}</td>
                    </tr>
                    <tr>
                        <th>Contact Person Email:</th>
                        <td>{{$referral->contact_email}}</td>
                    </tr> -->
                    <!-- <tr>
                        <th>Additional Billing Details if any:</th>
                        <td>{{$referral->invoice->additional_billing_details ?? 'N\A'}}</td>
                    </tr> -->
            

                </table>


                <div class="foot" style="margin: 2em 0px; text-align: center;">
                    <p>Moneywise Investments Plc</p>

        </section>

    </div>

</body>

</html>