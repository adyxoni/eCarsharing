var PaymentService = {

    init: function(){
        $("#addPayment").validate({
            submitHandler: function(form) {
                var payment = Object.fromEntries((new FormData(form)).entries());
                PaymentService.add(payment);
            }
        });
        PaymentService.list();
    },

    list: function(){
        $.get("api/payments", function( data ){

            $("#payment-list").html("");

            var html="";
            //counter j
            let j = 0;
            for(let i = data.length - 1; i >= data.length - 8; i--){
                if(i == 0) break;
                else{
                    html += `
                    <tr>
                    <th scope="row">${j+1}</th>
                    <td>`+ data[i].date +`</td>
                    <td>`+ data[i].time +`</td>
                    <td>`+ data[i].amount +`</td>
                    <td>`+ data[i].id +`</td>
                    </tr>`;
                    j++;
                }
            }
            $("#payment-list").html(html);
        });
    },

    get: function(id){
        $('.payment-details').attr('disabled', true);
        $.get('api/payments/'+id, function(data){
            $("#id").val(data.id);
            $("#date").val(data.date);
            $("#time").val(data.time);
            $("#amount").val(data.amount);
        })
  
    },

    add: function(payment){
        $.ajax({
            url: "api/payments",
            type: 'POST',
            data: JSON.stringify(payment),
            contentType: "application/json",
            dataType: "json",
            success: function(result){
                PaymentService.list();
                $("#addPaymentModal").modal("hide");
            }
        });
    },

    update: function(){
        $('.save-payment').attr('disabled', true);
        var payment = {};
  
        payment.id = $('#id').val()
        payment.date = $('#date').val();
        payment.time = $('#time').val();
        payment.amount = $('#amount').val();
  
        $.ajax({
          url: 'api/payments/'+$('#id').val(),
          type: 'PUT',
          data: JSON.stringify(payment),
          contentType: "application/json",
          dataType: "json",
          success: function(result){
            $("#exampleModal").modal("hide");
            PaymentService.list();
          }
        });
  
      },

      delete: function(id){
        $('.payment-details').attr('disabled', true);
        $.ajax({
          url: 'api/payments/'+id,
          type: 'DELETE',
          success: function(result){
            PaymentService.list();
  
          }
        });
      }
}