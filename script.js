$(document).ready(function () {
    $('#generateCitationButton').click(function () {
        // Call a function to send an AJAX request to the server
        generateAPACitation();
    });
});

function generateAPACitation() {
    $.ajax({
        url: 'citationcatch.php',
        type: 'GET',
        success: function (data) {
            // Display the result in the 'citationResult' div
            $('#citationResult').html(data);
        },
        error: function () {
            alert('Error generating citation.');
        }
    });
}
