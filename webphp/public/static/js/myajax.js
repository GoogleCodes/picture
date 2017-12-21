// 修改指定表的指定字段值
function changeTableVal(table,id_name,id_value,field,obj)
	{		
		var _class = "";
		if($(obj).attr('class').indexOf("fa-close") > 0 )
		{          
			_class = 'fa-check';
			var value = 1;
						
			}else{                    
				_class = 'fa-close';
				var value = 0;
			} 					
			$.ajax({
			url:"changeTableVal?table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,
			success: function(data){									
			$(obj).attr('class','fa '+_class);           
		}
	});		
}
// 修改指定表的排序字段
function updateSort(table,id_name,id_value,field,obj)
{		       
 		var value = $(obj).val();
		$.ajax({
				url:"changeTableVal?table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,			
				success: function(data){									
					 art.dialog({
                            content: '更新成功',
                            icon: 'succeed',
                        ok: function () {                                      
                            return true;
                        }
                    });
				}
		});		
}