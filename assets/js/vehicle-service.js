var VehicleService = {

    init: function(){
      $("#addVehicle").validate({
        submitHandler: function(form) {
          var vehicle = Object.fromEntries((new FormData(form)).entries());
          VehicleService.add(vehicle);
          }
       });
      VehicleService.list();
      },

    list: function(){
      $.get( "api/vehicles", function( data ) {

  $("#vehicle-list").html("");

  var html="";
  for(let i = 0; i < data.length; i++){
    html += `
    <tr>
      <th scope="row">${i+1}</th>
      <td>`+ data[i].car_brand +`</td>
      <td>`+ data[i].car_model +`</td>
      <td>`+ data[i].license_plate +`</td>
      <td>`+ data[i].price_per_hour +`</td>
      <td>`+ data[i].id +`</td>
      <td>
        <i class="fa fa-pencil payment-details" style="margin: 5px" onClick="VehicleService.get(`+ data[i].id +`)"></i>
        <i class="fa fa-trash payment-details" style="margin: 5px" onClick="VehicleService.delete(`+ data[i].id +`)"></i>
      </td>
    </tr>`;
  }
  $("#vehicle-list").html(html);

});


    },

    get: function(id){
      $('.vehicle-details').attr('disabled', true);
      $.get('api/vehicles/'+id, function(data){
        $("#id").val(data.id);
        $("#carBrand").val(data.car_brand);
        $("#carModel").val(data.car_model);
        $("#licensePlate").val(data.license_plate);
        $("#pricePerHour").val(data.price_per_hour);
        $("#exampleModal").modal("show");
        $('.vehicle-details').attr('disabled', false);
      })

    },

    add: function(vehicle){
      $.ajax({
        url: "api/vehicles",
        type: 'POST',
        data: JSON.stringify(vehicle),
        contentType: "application/json",
        dataType: "json",
        success: function(result){
          $("#addCarsModal").modal("hide");
          VehicleService.list();
        }
      });
    },

    update: function(){
      $('.save-vehicle').attr('disabled', true);
      var vehicle = {};

      vehicle.id = $('#id').val()
      vehicle.car_brand = $('#carBrand').val();
      vehicle.car_model = $('#carModel').val();
      vehicle.license_plate = $('#licensePlate').val();
      vehicle.price_per_hour = $('#pricePerHour').val();

      $.ajax({
        url: 'api/vehicles/'+$('#id').val(),
        type: 'PUT',
        data: JSON.stringify(vehicle),
        contentType: "application/json",
        dataType: "json",
        success: function(result){
          $("#exampleModal").modal("hide");
          VehicleService.list();
        }
      });

    },

    delete: function(id){
      $('.vehicle-details').attr('disabled', true);
      $.ajax({
        url: 'api/vehicles/'+id,
        type: 'DELETE',
        success: function(result){
          VehicleService.list();

        }
      });
    },

  }
