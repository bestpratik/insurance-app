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
                            Manage Purchase
                        </h3>
                    </div>

                </div>

                <!-- content here -->
                <livewire:master-insurance-purchase />    
                <!-- content here -->
            </div>
            <!-- Table Four -->
        </div>
    </div>
</x-app-layout>

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initAutocomplete&libraries=places&v=weekly" defer></script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script>

<!-- <script>
    let placeSearch;
    let autocomplete;
    const componentForm = {
        subpremise: "long_name",
        street_number: "long_name",
        route: "long_name",
        locality: "long_name",
        postal_code: "long_name",
        postal_town: "long_name",
        country: "long_name"
    };

    function initAutocomplete() {
        // console.log("Initializing autocomplete...");
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete"), {
                types: ["geocode"],
                componentRestrictions: {
                    country: "UK"
                }
            }
        ); // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.

        autocomplete.setFields(["address_component", "geometry"]);
        autocomplete.addListener("place_changed", fillInAddress);
    }

    function fillInAddress() {
        const place = autocomplete.getPlace();
        let route_val = '';
        let st_num_val = '';
        let premise_val = '';


        console.log(place.address_components);

        // for (const component in componentForm) {
        //   document.getElementById(component).value = "";
        //   document.getElementById(component).disabled = false;
        // } 

        for (const component of place.address_components) {
            const addressType = component.types[0];

            //console.log(addressType);

            if (componentForm[addressType]) {
                const val = component[componentForm[addressType]];
                document.getElementById(addressType).value = val;
                //console.log(val);
                if (addressType == 'route') {
                    route_val = val;
                }
                if (addressType == 'street_number') {
                    st_num_val = val;
                }

                let cncatval = st_num_val + ' ' + route_val;

                if (addressType === 'subpremise') {
                    const match = val.match(/\d+/);
                    premise_val = match ? match[0] : '';
                    // premise_val =val;
                }
                // console.log(premise_val);
                document.getElementById('subpremise').value = premise_val;
                document.getElementById('property_address').value = cncatval;

            }
        }


        //Lattitude and longitude
        document.getElementById("lat_code").value = place.geometry.location.lat();
        document.getElementById("lng_code").value = place.geometry.location.lng();
    }
</script> -->