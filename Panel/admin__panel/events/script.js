$(".delete").click(function () {
    let id = $(this).attr("data-id");
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            delete: 1,
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

$(".add").click(function () {
    let title = $('#NewTitle').val();
    let presenter =  $('#new_presenter').val();
    let coor_id =  $('#new_coor').val();
    let descibtion =  $('#Describtion').val();
    let date =  new Date($('#new_date').val());
    let day = date.getDate();
    let months = date.getMonth()+1;
    let year = date.getFullYear();
    let start_date = [year, months,day].join('/')
    console.log(start_date);
    console.log(typeof(start_date));
    if (!title || !presenter || !coor_id || !descibtion || !date){
        alert('Invalid values for inputs');
    }
    //console.log(category);
    else{
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            add_event:1,
            title: title,
            presenter_name: presenter,
            coordinator_id : coor_id,
            start_date:start_date ,
            description:descibtion ,
        },
        success: function (data) {
          location.reload();
          //console.log(data)
           if (data == 1){
               alert('something went wrong');
           }

            console.log("success");
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}
});

//-----------------------VIDEOS----------------------
$(".add_videos").click(function () {
    let video_title = $('#video_title').val();
    let video_url =  $('#video_url').val();
    let event_id =  $('#event_id').val();
    let video_descibtion =  $('#video_Describtion').val();

    console.log(typeof(event_id));
    if (!video_title || !video_url || !event_id || !video_descibtion){
        alert('Invalid values for inputs');
    }
    //console.log(category);
    else{
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            add_video:1,
            title: video_title,
            url: video_url,
            event_id : event_id,
            description:video_descibtion ,
        },
        success: function (data) {
          location.reload();
          //console.log(data)
           if (data == 1){
               alert('something went wrong');
           }
         
            console.log("success");
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}
});

$(".delete_videos").click(function () {
    let id = $(this).attr("data-id");
    $.ajax({
        url: "request_hander.php",
        type: "POST",
        data: {
            delete_videos: 1,
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




//--------------------- Sort tables (ASC - DEC) ------------------------------


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
       
    
} ) ));
