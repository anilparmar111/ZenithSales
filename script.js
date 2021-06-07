$(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){
		b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
			$(".product").select2(
				{
					placeholder :'please selct product'
				}
			);
			$(".product").last().next().next().remove();
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});
	$('#add_row').on('keyup change',function(){
		calc_total();
	});
	$('#inc').on('keyup change',function(){
		calc_total();
	});
	$('#gst').on('keyup change',function(){
		calc_total();
	});
	$('#ext').on('keyup change',function(){
		calc_total();
	});
	$('#box').on('keyup change',function(){
		calc_total();
	});
	$('#no').on('keyup change',function(){
		calc_total();
	});
		$('#cg').on('keyup change',function(){
		calc_total();
	});
	$('#delete_row').on('keyup change',function(){
		calc_total();
	});

});


function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			
			$(this).find('.total').val(qty*price);
			calc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });

		$('#ttl').val(total.toFixed(2));
	  
  var inc=parseFloat($("#inc").val());
  if(isNaN(inc))
  {
	  inc=0;
  }
//   alert(inc+100);
total=total+(total*inc)/100;
var gst=parseFloat($("#gst").val());
  if(isNaN(gst))
  {
	  gst=0;
  }
  var box=parseFloat($("#box").val());
  if(isNaN(box))
  {
	  box=0;
  }
  var no=parseFloat($("#no").val());
  if(isNaN(no))
  {
	  no=0;
  }
  var cg=parseFloat($("#cg").val());
  if(isNaN(cg))
  {
	  cg=0;
  }
  var ext=box*no;
  $('#ext').val(ext.toFixed(2));
  total=total+gst+ext+cg;
	$('#sub_total').val(total.toFixed(2));
	// tax_sum=total/100*$('#tax').val();
	// $('#tax_amount').val(tax_sum.toFixed(2));
	// $('#total_amount').val((tax_sum+total).toFixed(2));
}

// $(document).ready(function() {
//   $("#inc").keyup(function() {
//     alert($(this).val());
//   });
// });