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

</script>

</html>