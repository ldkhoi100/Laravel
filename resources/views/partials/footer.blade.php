</body>

<script>
    // Script Ckeditor 4
    CKEDITOR.replace("content");

    //Filter table
    $(document).ready(function(){
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    //Image onchange
    function readURL(event) {
        if (event.target.files && event.target.files[0]) {
        let reader = new FileReader();

        reader.onload = function () {
        let output = document.getElementById('zoom');
        output.src = reader.result;
        }

        reader.readAsDataURL(event.target.files[0]);
        }
    }

</script>

</html>