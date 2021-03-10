//---------------- categories ----------
$(".delete_cat").click(function () {
    let id = $(this).attr("data-id");
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            delete_cat: 1,
            id: id,
        },
        success: function (data) {
            //console.log(data);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});

$(".add_cat").click(function () {
    let category = $('#new_cat').val();
    if (category == "") {
        alert('Invalid Category Name');
    }
    //console.log(category);
    else {
        $.ajax({
            url: "request_hander.php",
            type: "POST",
            data: {
                add_cate: 1,
                name: category,
            },
            success: function (data) {
                if (data == 0) {
                    alert('Category already exists!');
                }
                else {
                    location.reload();
                    // console.log(data)
                    if (data == 1) {
                        alert('something went wrong');
                    }
                    console.log("success");
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    }
});

//--------------------author---------------------------


$(".delete_author").click(function () {
    let id = $(this).attr("data-id");
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            delete_author: 1,
            id: id,
        },
        success: function (data) {
            console.log(data);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});

$(".add_author").click(function () {
    let name = $('#author_name').val();

    //console.log(name);
    if (name == "") {
        alert('Invalid Author Name');
    }
    else {
        $.ajax({
            url: "request_hander.php",
            type: "POST",
            data: {
                add_author: 1,
                name: name,
            },
            success: function (data) {
                if (data == 0) {
                    alert('Author already exists!');
                }
                else if (data == 1) {
                    alert('something went wrong');
                }
                else {
                    console.log("success");
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    }
});


//--------------------author---------------------------


$(".delete_publish").click(function () {
    let id = $(this).attr("data-id");
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            delete_publish: 1,
            id: id,
        },
        success: function (data) {
            console.log(data);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});

$(".add_publish").click(function () {
    let publish_house = $('#new_publish').val();

    //console.log(name);
    if (publish_house == "") {
        alert('Invalid Publish House Name');
    }
    else {
        $.ajax({
            url: "request_hander.php",
            type: "POST",
            data: {
                add_publish: 1,
                name: publish_house,
            },
            success: function (data) {
                if (data == 0) {
                    alert('Publishing House already exists!');
                }
                else {
                    location.reload();
                    // console.log(data)
                    if (data == 1) {
                        alert('something went wrong');
                    }
                    console.log("success");
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    }
});


//--------------------------sort table ---------------------

const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));


document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {

    const table = th.closest('table');
    //console.log(table)
    const tbody = table.querySelector('tbody');
    Array.from(tbody.querySelectorAll('tr'))

        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => tbody.appendChild(tr))
})));


//----------------search table 1 author -------
function myFunction() {
    // Declare variables
    var input, filter, table1, tr, td, i, txtValue, found = 0;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table1 = document.getElementsByClassName("table1");
    //console.log(table1);
    tr = document.querySelectorAll('.table1 tr')
    console.log(tr.length)
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length - 1; i++) {
        let td2;
        td = tr[i].getElementsByTagName("td")[0]; //ID
        td2 = tr[i].getElementsByTagName("td")[1]; //name
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

//----------------search table 1 category -------
function myFunction2() {
    // Declare variables
    var input, filter, table1, tr, td, i, txtValue, found = 0;
    input = document.getElementById("myInput2");
    filter = input.value.toUpperCase();
    table1 = document.getElementsByClassName("table2");
    //console.log(table1);
    tr = document.querySelectorAll('.table2 tr')
    console.log(tr.length)
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length - 1; i++) {
        let td2;
        td = tr[i].getElementsByTagName("td")[0]; //ID
        td2 = tr[i].getElementsByTagName("td")[1]; //name
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


//----------------search table 3 publishing house -------
function myFunction3() {
    // Declare variables
    var input, filter, table1, tr, td, i, txtValue, found = 0;
    input = document.getElementById("myInput3");
    filter = input.value.toUpperCase();
    table1 = document.getElementsByClassName("table3");
    //console.log(table1);
    tr = document.querySelectorAll('.table3 tr')
    console.log(tr.length)
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length - 1; i++) {
        let td2;
        td = tr[i].getElementsByTagName("td")[0]; //ID
        td2 = tr[i].getElementsByTagName("td")[1]; //name
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