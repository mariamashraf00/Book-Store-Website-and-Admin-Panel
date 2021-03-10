var current_id = null;
var current_cell = null;
var current_index = null;
$('#Modal').on('shown.bs.modal', function () {
    $('#edit').trigger('focus')
})
$(".edit").click(function () {
    current_id = $(this).attr("data-id");
    current_index = $(this).attr("data-index");
    current_cell = ['title', 1];
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            get_video: 1,
            id: current_id,
            column: current_cell[0]
        },
        success: function (data) {
            $('#message-text').val(data);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});
$("#SelectColumn").change(function () {
    current_cell = $("#SelectColumn").val().split(" ");
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            get_video: 1,
            id: current_id,
            column: current_cell[0]
        },
        success: function (data) {
            $('#message-text').val(data);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});
$("#send").click(function () {
    var ok = true;
    $("#message-text").removeClass('is-invalid');
    if ($("#message-text").val().length === 0 || !$("#message-text").val().trim()) {
        $('#message-text').addClass('is-invalid');
        ok = false;
    }
    if (ok)
        $.ajax({
            url: "request_hander.php",
            type: "POST",
            data: {
                set_video: 1,
                id: current_id,
                column: current_cell[0],
                data: $('#message-text').val()
            },
            success: function (data) {
                var myTable = document.getElementById('dataTable');
                myTable.rows[current_index].cells[current_cell[1]].innerHTML = data;
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
});




//------------------------------------ search ----------------------------------------
function myFunction() {
    // Declare variables
    var input, filter, table1, tr1, td, i, txtValue, found = 0;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table1 = document.getElementsByTagName("table");
    //console.log(table1);
    tr = document.getElementsByTagName('tr')
    console.log(tr.length)
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length - 1; i++) {
        let td2;
        td = tr[i].getElementsByTagName("td")[0]; //ID
        td2 = tr[i].getElementsByTagName("td")[1]; //Title
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (td2) {
                txtValue2 = td2.textContent || td2.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                    found += 1;
                }

            }

        }
    }
    console.log(found)
    if (found == tr.length - 3) {
        alert('no result')
    }
}