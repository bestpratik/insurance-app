    <x-front>
   

  <section data-step="finish" class="flex justify-center items-center min-h-[300px] my-5">
                    <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md w-full text-center">
                        <svg class="mx-auto mb-4 text-green-500" xmlns="http://www.w3.org/2000/svg" width="120px"
                            height="120px" viewBox="0 0 52 52">
                            <circle class="stroke-current" cx="26" cy="26" r="25" fill="none" stroke-width="2" />
                            <path class="stroke-current" fill="none" stroke-width="3"
                                d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Insurance successfully purchased!</h2>
                        <p class="text-gray-600 mb-6">Thank You</p>
                    </div>
                </section>

</x-front>

<!-- Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<!-- Summernote) -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 50,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const a = document.getElementById("_dm-customWizardSteps"),
            d = new Zangdar("#_dm-customWizardForm", {
                onStepChange() {
                    a.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const b = d.getCurrentStep().label;
                    a.querySelector(`[data-step="${b}"]`).classList.add("active");
                },
            }),
            b = document.getElementById("_dm-progWizardSteps"),
            e = new Zangdar("#_dm-progWizardForm", {
                onStepChange() {
                    b.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const a = e.getCurrentStep().label;
                    b.querySelector(`[data-step="${a}"]`).classList.add("active");
                },
            }),
            c = document.getElementById("_dm-validWizardSteps"),
            f = new Zangdar("#_dm-validWizardForm", {
                onStepChange() {
                    c.querySelectorAll(".active").forEach((a) =>
                        a.classList.remove("active")
                    );
                    const a = f.getCurrentStep().label;
                    c.querySelector(`[data-step="${a}"]`).classList.add("active");
                },

            });
    });
</script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data ?');
    }
</script>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6y3AjuZl-L8qR8Mnm4DR5Fv2Xzl8IHjE&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<script type="text/javascript">
    $('.dropify').dropify();
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script type="text/javascript">
    function myFunction(targetId) {
        //alert(targetId);
        / Get the text field /
        var copyText = document.getElementById(targetId);

        / Select the text field /
        copyText.select();
        //copyText.setSelectionRange(0, 99999); / For mobile devices /

        / Copy the text inside the text field /
        navigator.clipboard.writeText(copyText.value);

        / Alert the copied text /
        swal("Text is coppied " + copyText.value);
    }
</script>