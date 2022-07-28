var CommentService = {

    init: function(){
        $("#addComment").validate({
            submitHandler: function(form) {
                var comment = Object.fromEntries((new FormData(form)).entries());
                CommentService.add(comment);
            }
        });
        CommentService.list();
        CommentService.count();
    },

    list: function(){
        $.get("api/comments", function( data ) {

            $("#comment-list").html("");

            var html = "";
            var timeSince = "";

            for(let i = data.length - 1; i >= 0; i--){

                timeSince = CommentService.timeSince(data[i].posted)
                
                if(i % 2 == 0){
                    html += `
                    <li class="left clearfix">

                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class="pull-right text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> ${timeSince}
                                </small>
                            </div>
                            <p>`+ data[i].comment +`</p>
                        </div>
                    </li>`;
                } else {
                    html += `
                    <li class="right clearfix">

                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> ${timeSince}
                                </small>
                            </div>
                            <p>`+ data[i].comment +`</p>
                        </div>
                    </li>`;
                }
            }
            $("#comment-list").html(html);
        });
    },

    get: function(id){
      $('.todo-details').attr('disabled', true);
      $.get('api/todos/'+id, function(data){
        $("#id").val(data.id);
        $("#comment").val(data.comment);
        $("#posted").val(data.posted);
      })
    },

    add: function(comment){
      $.ajax({
        url: "api/comments",
        type: 'POST',
        data: JSON.stringify(comment),
        contentType: "application/json",
        dataType: "json",
        success: function(result){
          CommentService.list();
          CommentService.count();
        }
      });
    },

    count: function(){
      $.get("api/comments", function( data ){

          $("#total-comments").html("");
          var counter = 0;

          for(let i = 0; i < data.length; i++) counter++;
          $("#total-comments").html(counter);
      });
    },

    timeSince: function(datetime){
        var dateValue = Math.abs((new Date(datetime).getTime() / 1000).toFixed(0));
        var currentDate = Math.abs((new Date().getTime() / 1000).toFixed(0));

        var diff = currentDate - dateValue;

        var days = Math.floor(diff / 86400);
        var hours = Math.floor(diff / 3600) % 24;
        var minutes = Math.floor(diff / 60) % 60;
        var seconds = diff % 60;

        if(days >= 2) return days + " days ago";
        else if (days == 1){
            hours += hours + 24;
            return  hours + " hrs ago";
        } 
        else if (hours < 24 && hours > 0) return hours + " hrs ago";
        else if(hours == 1) return hours + " hr ago";
        else if(minutes == 1 && hours < 1) return minutes + " min ago";
        else if(hours < 1 && minutes > 0) return minutes + " mins ago";
        else if(minutes < 1 && seconds > 1) return seconds + " secs ago";
        else return "Just now!";
    }
}
