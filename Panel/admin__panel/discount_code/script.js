$(".add_code").click(function () {
    let code = $('#new_code').val();
    let percentage = $('#new_per').val();
    let s_date = new Date($('#start_date').val());
    let s_day = s_date.getDate();
    let s_month = s_date.getMonth() + 1;
    let s_year = s_date.getFullYear();
    let start_date = [s_year, s_month, s_day].join('/');
    let e_date = new Date($('#end_date').val());
    let e_day = e_date.getDate();
    let e_month = e_date.getMonth() + 1;
    let e_year = e_date.getFullYear();
    let end_date = [e_year, e_month, e_day].join('/');

    if (s_date > e_date) {
        alert('Start Date can\'t be larger than Expire Date');
    }
    else if (percentage < 0) {
        alert('percentage can\'t be negative value');
    }
    else {


        console.log(end_date);
        if (!code || !percentage || !start_date || !end_date) {
            alert('Invalid values for inputs');
        }

        else {
            $.ajax({
                url: "request_handler.php",
                type: "POST",
                data: {
                    add_code: 1,
                    code: code,
                    percentage: percentage,
                    start_date: start_date,
                    expiry_date: end_date,
                },
                success: function (data) {
                    if (data == 0) {
                        alert('Code already exists!');
                    }
                    else if (data == 1) {
                        alert('Error in DB!');
                    }
                    else {
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
            });
        }
    }
});

$(".delete_code").click(function () {
    let id = $(this).attr("data-id");
    $.ajax({
        url: "request_handler.php",
        type: "POST",
        data: {
            delete_codes: 1,
            code: id,
        },
        success: function (data) {
            //console.log(data);
            if (data == 0) {
                alert('Something Went Wrong')
            }
            location.reload();

        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});



var current_id = null;
var current_cell = null;
var current_index = null;
$('#Modal').on('shown.bs.modal', function () {
    $('#edit').trigger('focus')
})
$(".edit").click(function () {
    current_id = $(this).attr("data-id");
    console.log(current_id);
    current_index = $(this).attr("data-index");
    console.log(current_index);
    current_cell = ['code', 1];
    $.ajax({
        url: "request_handler.php",
        type: "POST",
        data: {
            get_code: 1,
            code: current_id,
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
        url: "request_handler.php",
        type: "POST",
        data: {
            get_code: 1,
            code: current_id,
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
    let valid = true;
    if (current_cell[0] == 'code') {
        // console.log(current_cell[0])
        if ($('#message-text').val() == '') {
            alert('code can\'t be empty');
            valid = false;
        }
    }
    else if (current_cell[0] == 'percentage') {
        if ($('#message-text').val().length === 0 || !$('#message-text').val().trim() || !/^-?\d+$/.test($('#message-text').val())
            || $('#message-text').val() < 0 || $('#message-text').val() > 100) {
            alert('invalid input for Percentage ')
            valid = false;
        }
    }
    else {

        if (!/^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/.test($('#message-text').val())) {
            alert('invalid date');
            valid = false;
        }
    }
    console.log(valid)

    if (valid) {
        $.ajax({
            url: "request_handler.php",
            type: "POST",
            data: {
                set_code: 1,
                code: current_id,
                column: current_cell[0],
                data: $('#message-text').val()
            },
            success: function (data) {
                if (data == 0) {
                    alert('DB Error!');
                }
                else {
                    var myTable = document.getElementById('dataTable');
                    myTable.rows[current_index].cells[current_cell[1]].innerHTML = data;
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    }
});




//------------------------------------sort table----------------------------------------





const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));


document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    //    var array_up = document.getElementById('hidden1');
    //    var array_down = document.getElementById('hidden2');
    const table = th.closest('table');
    //console.log(table)
    const tbody = table.querySelector('tbody');
    Array.from(tbody.querySelectorAll('tr'))

        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => tbody.appendChild(tr))
    // if (this.asc){
    //     array_up.style.visibility = "visible";
    //     array_down.style.visibility = "hidden";
    //     console.log('fir')
    // }
    // else{
    //     array_up.style.visibility = "hidden";
    //     array_down.style.visibility = "visible";
    //     console.log('sec')
    // }


})));



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
        td = tr[i].getElementsByTagName("td")[1]; //code
        td2 = tr[i].getElementsByTagName("td")[3]; //start date
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