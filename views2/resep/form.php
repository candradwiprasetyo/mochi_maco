<script type="text/javascript">

function CurrencyFormat(number)
{
   var decimalplaces = 0;
   var decimalcharacter = "";
   var thousandseparater = ".";
   number = parseFloat(number);
   var sign = number < 0 ? "-" : "";
   var formatted = new String(number.toFixed(decimalplaces));
   if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
   var integer = "";
   var fraction = "";
   var strnumber = new String(formatted);
   var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
   if( dotpos > -1 )
   {
      if( dotpos ) { integer = strnumber.substr(0,dotpos); }
      fraction = strnumber.substr(dotpos+1);
   }
   else { integer = strnumber; }
   if( integer ) { integer = String(Math.abs(integer)); }
   while( fraction.length < decimalplaces ) { fraction += "0"; }
   temparray = new Array();
   while( integer.length > 3 )
   {
      temparray.unshift(integer.substr(-3));
      integer = integer.substr(0,integer.length-3);
   }
   temparray.unshift(integer);
   integer = temparray.join(thousandseparater);
   return sign + integer + decimalcharacter + fraction;
}

function test(){
	alert("test");
}

function add_menu(id)
{
	var i_id = document.getElementById("i_id").value;
	//alert("test");

	if(id!=0){
		
		window.location.href = 'resep.php?page=add_menu&item_id='+id+'&i_id='+i_id;
	}

}


<?php
while($row_item4 = mysql_fetch_array($query_item4)){
?>
function edit_qty_<?= $row_item4['resep_detail_id']?>(data){
	
	//alert(data);
	if(data > 0){
				
	 			$.ajax({
					type: "GET",
					url: "resep.php?page=edit_qty",
					data:{id:<?= $row_item4['resep_detail_id']?>, qty:data}
				}).done(function( result ) {
				   //alert("Simpan berhasil");
				});
				
	}else{
		alert("Qty tidak boleh kurang dari 0");
	}
}

	

<?php

}
?>

function go_to_payment(){
		
		var total = document.getElementById("i_total").value;
		
		//alert(total);
		
		
		if(total > 1){
			
			var i_name = document.getElementById("i_nama").value;
			var i_item_produck = document.getElementById("i_item_produck").value;
			var i_id = document.getElementById("i_id").value;
			
			//alert(total);
			window.location.href = 'resep.php?page=save&i_name='+i_name+'&i_item_produck='+i_item_produck+'&i_id='+i_id;
			
		}else{
			alert("Simpan gagal. Order menu masih kosong");
		}
		
	}
</script>
	
                <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Simpan Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['err']) && $_GET['err'] == 1){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-warning alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Simpan Gagal !</b>
               Menu masih kosong, Pilih menu terlebih dahulu !
                </div>
           
                </section>
                <?php
                }
                ?>
       
        
      
                

<!-- Main content -->
<section class="content">

            <div class="row">
            
            
            <div class="col-xs-4">
           <div class="form-group">
                                            <label>Nama Resep</label>
                                            <input required type="text" id="i_nama" name="i_nama" class="form-control" placeholder="Masukkan nama resep....." value="<?=$row->resep_name ?>"/>
                                            <input type="hidden" id="i_id" name="i_id" value="<?=$row->resep_id ?>"/>
                                        </div>
            </div>
            
             <div class="col-xs-4">
             <div class="form-group">
                                         <label>Item </label>
                                        <select name="i_item_produck" id="i_item_produck"  class="selectpicker show-tick form-control" data-live-search="true" onChange="load_data(this.value)" >
                                        <?php
                                        $query_item7 = mysql_query("select a.*, b.unit_name 
                                                    from items a 
                                                    join units b on b.unit_id = a.unit_id
                                                    order by item_id
																	");
                                        while($row_item7 = mysql_fetch_array($query_item7)){
                                        ?>
                                        <option <?php if($row_item7['item_id'] == $row->item_id){ ?> selected="selected" <?php }?> value="<?= $row_item7['item_id']?>"><?php
										
										echo $row_item7['item_name']." (".$row_item7['unit_name'].")"; ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                      	</div>
            </div>  
            
            
            <!-- list menu -->
            
             <div class="row">
                        <div class="col-xs-12">
                            
                            
                            
                            <div class="box">
                             
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th width="5%">No</th>
                                                <th width="30%">Nama Item</th>
                                                  <th width="10%">Qty</th>
                                                   <th width="10%">Config</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                         <?php
                                           $no = 1;
										   while($row_item = mysql_fetch_array($query_item)){
                                            ?>
                                            <tr>
                                            	<td><?= $no?></td>
                                               <td><?= $row_item['item_name']?></td>
                                               <td>
                                             <input name="i_qty_<?php echo $row_item['resep_detail_id']?>" type="text" id="i_qty_<?php echo $row_item['resep_detail_id']?>" value="<?php echo $row_item['resep_detail_qty']?>"  class="form-control" onchange="edit_qty_<?php echo $row_item['resep_detail_id']?>(this.value)" />
                                             
                                             </td>
                                               <td style="text-align:center;">
                                                    <a href="javascript:void(0)" onclick="confirm_delete(<?= $row_item['resep_detail_id']; ?>,'resep.php?page=delete_item&id=')" class="btn btn-default" ><i class="fa fa-trash-o"></i></a>

                                                </td> 
                                            </tr>
                                            <?php
											$no++;
                                            }
										// }
											?>
                                          

                                          
                                        </tbody>
                                         <tfoot>
                                          <tr>
                                          <td></td>
                                          <td>
                                          <select name="i_menu_id" id="i_menu_id"  class="selectpicker show-tick form-control" data-live-search="true" onchange="add_menu(this.value)" >
                                          <option value="0">Add Item</option>
                                        <?php
                                        $query_item = mysql_query("select * from items order by item_id
																	");
                                        while($row_item = mysql_fetch_array($query_item)){
                                        ?>
                                        <option value="<?= $row_item['item_id']?>"><?php
										
										echo $row_item['item_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                         </td>
                                          <td><input type="hidden" id="i_total" value="<?=$no?>"></td>
                                            <td align="right" valign="middle" style="font-size:22px;"><strong></strong></td>
                                              
                                           </tr>
                                           
                                         </tfoot>
                                         
                                    </table>
                             
                   </div><!-- /.box -->
                            
                             <a href="javascript: go_to_payment()"  class="btn btn-success" >SAVE</a>
                            

                        </div>
                        
                        
                    </div>
            
            <!-- list menu -->
     
 
  
 
</section><!-- /.content -->

              
              
           
              
              
            