$(document).ready(function(){

    var url = "/admin/cyclepics";

    //display modal form for task editing
    $('.open-modal').click(function(){
        var task_id = $(this).val();

        $.get(url + '/' + task_id, function (data) {
            //success data
            $('#task_idEdit').val(data.id);
            $('#titleEdit').val(data.title);
            $('#link_pathEdit').val(data.link_path);
            $('#btn-saveEdit').val("update");

            $('#editModal').modal('show');
        })
    });

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete task and remove it from list

    $('.delete-task').click(function(){

        $('#checkModal').modal('show');

        $id=$(this).val();
        $('#checkModal').modal().one('click', '#checkDel', function() {
            var task_id = $id;

            $.ajaxSetup({
             headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
             })

             $.ajax({
                 type: "DELETE",
                 url: url + '/' + task_id,
                 success: function (data) {
                     console.log(data);
                     $("#task" + task_id).remove();

                 },
                 error: function (data) {
                    console.log('Error:', data);
                 }
             });

            $('#checkModal').modal('hide');
        });
    });


    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        console.log('token'+$('meta[name="_token"]').attr('content'));

        e.preventDefault();

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var task_id = $('#task_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + task_id;
        }

        var form = document.getElementById('frmTasks');
        var formData=new FormData(form);

        console.log(type+ ' '+ my_url);

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            processData: false,
            contentType:false,
            dataType: 'json',
            success: function (data) {

                console.log(data);

                location.reload();

                $('#frmTasks').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});