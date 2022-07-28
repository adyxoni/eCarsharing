var TodoService = {

    init: function(){
      $("#addTodo").validate({
        submitHandler: function(form) {
          var todo = Object.fromEntries((new FormData(form)).entries());
          TodoService.add(todo);
          }
       });
      TodoService.list();
      },

    list: function(){
        $.get("api/todos", function( data ) {

            $("#todo-list").html("");

            var html = "";
            var icon = "";
            var badge = "plus";
            var color = "";

            for(let i = 0; i < data.length; i++){
                icon = parseInt(data[i].icon);
                switch(icon){
                    case 0:
                      badge = "plus";
                      color = "success";
                      break;
                    case 1:
                      badge = "wrench";
                      color = "warning";
                      break;
                    case 2:
                      badge = "trash";
                      color = "danger";
                      break;
                    case 3:
                      badge = "info";
                      color = "info";
                      break;
                    case 4:
                      badge = "credit-card"
                      color = "primary";
                      break;
                    default:
                      badge = "font-awesome";
                      color = "muted";
                      break;
                }
                if(i % 2 == 0){
                    html += `
                    <li>
                        <div class="timeline-badge ${color}"><i class="fa fa-${badge}"></i></div>
                        <div class="timeline-panel">

                            <div class="timeline-heading">
                                <h4 class="timeline-title">`+ data[i].title +`</h4>
                            </div>

                            <div class="timeline-body">
                                <p>`+ data[i].body +`</p>
                            </div>

                            <div class="container row d-flex align-items-end" style="padding-top: 5px">
                                <i class="fa fa-pencil todo-details col col-6" style="margin: 5px" onClick="TodoService.get(`+ data[i].id +`)"></i>
                                <i class="fa fa-trash todo-details col col-6" style="margin: 5px" onClick="TodoService.delete(`+ data[i].id +`)"></i>
                            </div>

                        </div>
                    </li>`;
                } else {
                    html += `
                    <li class="timeline-inverted">
                        <div class="timeline-badge ${color}"><i class="fa fa-${badge}"></i></div>
                        <div class="timeline-panel">

                            <div class="timeline-heading">
                                <h4 class="timeline-title">`+ data[i].title +`</h4>
                            </div>

                            <div class="timeline-body">
                                <p>`+ data[i].body +`</p>
                            </div>

                            <div class="container row d-flex align-items-end" style="padding-top: 5px">
                                <i class="fa fa-pencil todo-details col col-6" style="margin: 5px" onClick="TodoService.get(`+ data[i].id +`)"></i>
                                <i class="fa fa-trash todo-details col col-6" style="margin: 5px" onClick="TodoService.delete(`+ data[i].id +`)"></i>
                            </div>

                        </div>
                    </li>`;
                }
            }
            $("#todo-list").html(html);
        });
    },

    get: function(id){
      $('.todo-details').attr('disabled', true);
      $.get('api/todos/'+id, function(data){
        $("#id").val(data.id);
        $("#todoTitle").val(data.title);
        $("#todoBody").val(data.body);
        $("#todoIcon").val(data.icon);
        $("#todoModal").modal("show");
        $('.todo-details').attr('disabled', false);
      })
    },

    add: function(todo){
      $.ajax({
        url: "api/todos",
        type: 'POST',
        data: JSON.stringify(todo),
        contentType: "application/json",
        dataType: "json",
        success: function(result){
          $("#addTodoModal").modal("hide");
          TodoService.list();
          console.log("success");
        }
      });
    },

    update: function(){
      $('.save-todo').attr('disabled', true);
      var todo = {};

      todo.id = $('#id').val()
      todo.title = $('#todoTitle').val();
      todo.body = $('#todoBody').val();
      todo.icon = $('#todoIcon').val();

      $.ajax({
        url: 'api/todos/'+$('#id').val(),
        type: 'PUT',
        data: JSON.stringify(todo),
        contentType: "application/json",
        dataType: "json",
        success: function(result){
          $("#todoModal").modal("hide");
          TodoService.list();
        }
      });

    },

    delete: function(id){
      $('.todo-details').attr('disabled', true);
      $.ajax({
        url: 'api/todos/'+id,
        type: 'DELETE',
        success: function(result){
          TodoService.list();

        }
      });
    },

  }
