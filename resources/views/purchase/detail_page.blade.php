<x-app-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            <!-- Table Four -->
            @if (session('success'))
            <div class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50  dark:text-green-400">
                {{ session('success') }}
            </div>
            @endif
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 ">
                <div class="flex flex-col gap-5 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-semibold  /90">
                            View Purchase Details
                        </h3>
                    </div>

                </div>

                <!-- content here -->
                <section id="content" class="content">
                    <div class="content__boxed">
                        <div class="content__wrap">
                            <div class="card mt-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="lafe-t-side">
                                                <h2> Policy Information</h2>
                                                <hr style="margin: 5px;">
                                                <table class="table table-borderd" style="font-weight: 400;">
                                                    <tr>
                                                        <td style="line-height: 18px;"><b>Insurance Name</b></td>
                                                        <td>{{  $purchase->insurance->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 18px;"><b>Policy Number</b></td>
                                                        <td>{{  $purchase->policy_no }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td style="line-height: 18px;"><b>Purchased By</b></td>
                                                        <td>
                                                            {{ auth()->user()->name }}
                                                        </td>
                                                    </tr>

                                                </table>
                                                <h2 style="margin-top: 1em;">Important Dates</h2>
                                                <hr style="margin: 5px;">
                                                <table class="table table-borderd" style="font-weight: 400;">
                                                    <tr>
                                                        <td style="line-height: 18px;"><b>Purchase Date</b></td>
                                                        <td>
                                                           {{  $purchase->purchase_date }}
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>


                                        </div>


                                        <div class="col-md-7">
                                            <h3 style="font-weight: 500; margin-top: 0;"> Payment Summary</h3>
                                            <table class="table table-bordered tbb" style="margin-bottom: 2em;">
                                                <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                    <tr>
                                                        <th style="color: white;">Policy Start Date</th>
                                                        <th style="color: white;">Policy end Date</th>
                                                        <th style="color: white;">Ast start date</th>
                                                        <th style="color: white;">Purchase Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                           {{ \Carbon\Carbon::parse($purchase->policy_start_date)->format('d M Y') }}

                                                        </td>
                                                        <td>
                                                           {{ \Carbon\Carbon::parse($purchase->policy_end_date)->format('d M Y') }}

                                                        </td>
                                                        <td>
                                                           {{ \Carbon\Carbon::parse($purchase->ast_start_date)->format('d M Y') }}

                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <!---->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered tbb">
                                                        <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                            <tr>
                                                                <th style="color: white">Landloard/Agency Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                   
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered tbb">
                                                        <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                            <tr>
                                                                <th style="color: white">Property Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                   {{  $purchase->door_no }},{{  $purchase->address_one }},{{  $purchase->address_two }},{{  $purchase->address_three }},{{  $purchase->post_code }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered tbb">
                                                        <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                            <tr>
                                                                <th style="color: white">Tenant Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    {{  $purchase->tenant_name }}</br>
                                                                    {{  $purchase->tenant_email }}</br>
                                                                    {{  $purchase->tenant_phone }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <div class="col-md-12 block-ap" style="margin-top: 2em;">
                                                    <table class="table table-bordered tbb">
                                                        <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                            <tr>
                                                                <th style="color: white">Static Policy Documents</th>
                                                            </tr>
                                                        </thead>
                                                        

                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <!-- @if($purchase->insurance &&                     $purchase->insurance->staticdocuments->count())
                                                                        @foreach($purchase->insurance->staticdocuments as $doc)
                                                                            <div class="hit-blk mb-2">
                                                                                <a href="{{ asset('uploads/insurance_document' . $doc->document) }}" target="_blank">
                                                                                    📄 {{ $doc->title }}
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="text-muted">No static documents available.</div>
                                                                    @endif -->


                                                                    <td>
                                                                        @if($purchase->insurance && $purchase->insurance->staticdocuments->count())
                                                                            @foreach($purchase->insurance->staticdocuments as $doc)
                                                                                <div class="hit-blk mb-2">
                                                                                    <a href="{{ route('static.document.generate.pdf', $doc->id) }}" target="_blank">
                                                                                        📄 {{ $doc->title }}
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="text-muted">No static documents available.</div>
                                                                        @endif
                                                                    </td>

                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </div>

                                                 <div class="col-md-12 block-ap" style="margin-top: 2em;">
                                                    <table class="table table-bordered tbb">
                                                        <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                            <tr>
                                                                <th style="color: white">Dynamic Policy Documents</th>
                                                            </tr>
                                                        </thead>
                                                        

                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <td>
                                                                        
                                                                    </td>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </div>

                                              

                                                
                                                <div class="col-md-12 block-ap">
                                                    <table class="table table-bordered tbb">
                                                        <thead style="background:#3e3d3d;color:#fff;font-weight:bold">
                                                            <tr>
                                                                <th style="color: white">Invoice</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="hit-blk">
                                                                        <a href="" target="_blank">
                                                                            <img src="" style="width:68px; padding:10px">
                                                                            <span class="text-center">Invoice</span>
                                                                        </a>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- content here -->
            </div>
            <!-- Table Four -->
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script>