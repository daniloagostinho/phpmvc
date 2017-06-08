$(function(){

	 
	$('.btn-deletar').on('click', function(event) {		
		var atividadeid = $(this).data("atividade-id");
		$(".modal-footer #id-atividade-deletada").val(atividadeid);
		 //console.log(atividadeid);
	});	
	
	$('#delete').on('hidden.bs.modal', function () {
		location.reload();
		});
	
	$(".modal-footer #deleta-atividade").click(function(){
		var uriDel = 'id='+$(".modal-footer #id-atividade-deletada").val()+'&action=delete';
		//console.log(uriDel);
		 $.ajax({
		        type: "POST",
		        url: "../controller/Controller.php",
		        data: uriDel,
		        datatype: "text/html",
		        success: function (response) { 
		        	$('#delete').modal('hide');
		        	
		        }
		        
		   });	
		});
	
	 $('.form_datetime').datetimepicker({
	   	 language:  'pt-BR',
	   	 format: "dd MM yyyy - hh:ii",
	     autoclose: true,
	     todayBtn: true,
	     startDate: "2017-01-01 10:00",
	     minuteStep: 30
	    }); 
	
	$('#characterLeft').text('faltam 600 caracteres');
    $('#descricao').keydown(function () {
        var max = 600;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('Você chegou ao limite');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');            
        } 
        else {
            var ch = max - len;
            $('#characterLeft').text('faltam ' + ch + ' caracteres');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');            
        }
    });
    
    $('#cadastra').click(function () {
        $.ajax({
          type: 'post',
          url: '../controller/Controller.php',
          data: $('#formAtividade').serialize()+"&action=insert",
          success: function (response) {
        	  window.location='list.php';
          }
        });
        return false;
      });
    
    $('#atualiza').click(function ()  {
    	console.log($('#formAtividade').serialize()+"&action=update&id="+$("#idUpdade").val());
        $.ajax({
          type: 'post',
          url: '../controller/Controller.php',
          data: $('#formAtividade').serialize()+"&action=update&id="+$("#idUpdade").val(),
          success: function (response) {
        	  console.log(response);
        	  window.location='list.php';
          }
        });
        return false;
      });
    
    $('.criarnovo').click(function(){    	
    	window.location='detail.php';
    });
    
    $("#status").on('change',function(){
    	if($("#status").val()=="4"){ 
    		alert('Informe a data final!');
    		$(".datafinal").css('color',"#ff0000");
    	}
    });
    
    $('.btn-filter').on('click', function () {
        var $target = $(this).data('target');
        if ($target != 'todos') {
          $('.table tr').css('display', 'none');
          $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
        } else {
          $('.table tr').css('display', 'none').fadeIn('slow');
        }
      });

});