<footer>
        
        </footer>
    </body>

    <script>
$(document).ready(function () {
    $('#oneWayForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from traditional submission
        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            type: 'GET',
            url: 'admin\database\connection.php', // Use the appropriate URL
            data: formData,
            success: function (data) {
                $('#flightResultsTable tbody').html(data);
            }
        });
    });

    $('#roundTripForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from traditional submission
        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            type: 'GET',
            url: 'admin\database\connection.php', // Use the appropriate URL
            data: formData,
            success: function (data) {
                $('#flightResultsTable tbody').html(data);
            }
        });
    });
});
</script>

    </html>