<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.jqueryui.min.css"/>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <style>
  	::-webkit-input-placeholder {
   font-style: italic;
}
:-moz-placeholder {
   font-style: italic;  
}
::-moz-placeholder {
   font-style: italic;  
}
:-ms-input-placeholder {  
   font-style: italic; 
}
  </style>
  <body>
    <div class="container-xl">
    	<div class="table-responsive col-md-12">
    		<div class="table-wrapper">
    			<div class="table-title">
    				<br><br>
    				<div class="row">
    					<div class="col-md-2">
    						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategory" data-bs-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp  Ödəniş Növü </button>	
    					</div>
    					<div class="col-md-2">
    						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcurrency" data-bs-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp Yeni Valyuta </button>	
    					</div>
    					<div class="col-md-2">
    						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpayment" data-bs-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp Yeni Ödəniş</button>	
    					</div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addincome" data-bs-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp Yeni Mədaxil</button> 
              </div>
              <div class="col-md-2" style="margin-left:12%;"><h3> BALANS: <?php echo @$balance->balance; ?></h3></div>
    				
    				</div>
    				
    				<br>
            <hr>
            
				   <table id="paymenttable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

					  <thead>
              <tr >
               <h2 style="text-align: center;">Ödəniş Tarixçəsi</h2> 
              </tr>
					    
                <tr>
                  <td>
                    <select name="filterr" id="curfilter" style="width:150px;height: 30px;">
                      <option value="">filter</option>
                      <?php foreach ($currencies as $currency ): ?>
                        <option value="<?php echo $currency->name ?>"><?php echo $currency->name ?> </option>
                      <?php endforeach ?>
                      

                    </select>
                  </td>
                  
                  <td>
                    <td><select name="filter" id="catfilter" style="width:150px;height: 30px;">
                      <option value="">filter</option>
                    <?php foreach ($categories as $category ): ?>
                        <option value="<?php echo $category->name ?>"><?php echo $category->name ?> </option>
                    <?php endforeach ?>
                  </select></td>
                  </td>
                  <td></td>
                  <td>
                    <form >
                    <input type="date" id="initial">
                    <input type="date" id="end">
                    <button type="button" id="fltrbydate"><i class="fa-solid fa-filter"></i></button>
                    </form>
                  </td>
                </tr>
                <tr>
					      <th class="th-sm">Valyuta &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
					      </th>
					      <th class="th-sm">Açıqlama &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
					      </th>
					      <th class="th-sm">Kateqoriya &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
					      </th>
					      
					      <th class="th-sm">Məxaric &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
					      </th>
					     
					      <th class="th-sm">Tarix &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
					      </th>
					    </tr>
             
					  </thead>
              <tbody class="paymentbody" id="pymntbdy">
              <?php foreach ($payments as $payment): ?>
                <tr>
                  <td name="currency"><?php echo $payment->curname ?> </td>
                  <td name="description"><?php echo $payment->description ?>  </td>
                  <td name="category"><?php echo $payment->catname ?>  </td>
                  <td name="amount"><?php echo "-".$payment->amount ?> </td>
                  <td name="tarix"><?php echo $payment->date ?> </td>
                </tr>
              <?php endforeach ?>

              
            </tbody>
					  
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo "-".$totalpayment->total; ?> </td>
                <td></td>
                </tr>
            </tfoot>
					</table>
          <br><br>
           <table id="incometable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

            <thead>
              <tr >
               <h2 style="text-align: center;">Mədaxil Tarixçəsi</h2> 
              </tr>
              <tr>
                <th  class="th-sm">Valyuta &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
                </th>
                <th class="th-sm">Açıqlama &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
                </th>
                <th class="th-sm">Kateqoriya &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
                </th>
                
                
                <th class="th-sm">Mədaxil &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
                </th>
               <!--  <th class="th-sm">Əməliyyat
                </th> -->
                <th class="th-sm">Tarix &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa-solid fa-arrow-down-wide-short"></i>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($incomes as $income): ?>
                <tr>
                  <td name="currency"><?php echo $income->curname ?> </td>
                  <td name="description"><?php echo $income->description ?>  </td>
                  <td name="categpry"><?php echo $income->catname ?>  </td>
                  <td name="amount"><?php echo "+".$income->amount ?> </td>
                  <td name="tarix"><?php echo $income->date ?> </td>
                </tr>
              <?php endforeach ?>
              
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo "+".$totalincome->total; ?> </td>
                <td></td>
                </tr>
            </tfoot>
          </table>
    			</div>
    		</div>
    	</div>
    	
    </div>
<!-- Kateqoriya Elave Etme Modali -->
<div class="modal fade" id="addcategory" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yeni Kateqoriya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" id="catname" placeholder="Məs. Ərzaq " required />
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İmtina</button>
        <button type="submit" class="btn btn-primary" id="catadd" data-bs-dismiss="modal">Tamamla</button>
      </div></form>
    </div>
  </div>
</div>

<!-- Valyuta Elave Etme Modali -->
<div class="modal fade" id="addcurrency" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Valyuta Əlavə Et</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="name" class="col-form-label">Valyuta:<sup style="color:red;">*</sup></label>
            <input type="text" class="form-control" id="name" placeholder="Məs. USD" required><br>
            <label for="fullname" class="col-form-label">Valyuta Tam Adı:<sup style="color:red;">*</sup></label>
            <input type="text" class="form-control" id="fullname" placeholder="United States Dollar" required><br>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İmtina</button>
        <button type="button" class="btn btn-primary" id="curadd" data-bs-dismiss="modal">Tamamla</button>
      </div></form>
    </div>
  </div>
</div>
<!-- Ödəniş Əlavə Etmə Modali -->
<div class="modal fade" id="addpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ödəniş Əlavə Et</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="desc" class="col-form-label">Açıqlama: </label>
            <input type="text" class="form-control" id="desc" placeholder="Məs. 2 kitab aldım"><br>
            <label for="amount" class="col-form-label">Məbləğ:<sup style="color:red;">*</sup></label>
            <input type="text" class="form-control" id="amount" placeholder="Məs. 300" required><br>

            <select name="category" id="catsel" class="form-select" aria-label="Default select example">
	          <option value="Choose Category">Kateqoriya Seçin<sup style="color:red;">*</sup></option>
	          <?php foreach ($categories as $category): ?>
	          <option value="<?php echo $category->name ?>"><?php echo $category->name ?></option>
	          <?php endforeach ?>
            </select>
            <br>
            <select name="currency" id="cursel" class="form-select" aria-label="Default select example">
            <option value="Choose Currency">Valyuta Seçin<sup style="color:red;">*</sup></option>
            <?php foreach ($currencies as $currency): ?>
            <option value="<?php echo $currency->name ?>"><?php echo $currency->name ?></option>
            <?php endforeach ?>
            </select>
            <label for="date" class="col-form-label">Tarix:<sup style="color:red;">*</sup></label>
            <input type="date" class="form-control" id="date" required><br>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İmtina</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="payadd">Tamamla</button>
      </div></form>
    </div>
  </div>
</div>
<!-- Mədaxil Əlavə Etmə Modali -->
<div class="modal fade" id="addincome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mədaxil Əlavə Et</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="desc" class="col-form-label">Açıqlama: </label>
            <input type="text" class="form-control" id="descc" placeholder="Məs. 2 kitab aldım"><br>
            <label for="amount" class="col-form-label">Məbləğ:<sup style="color:red;">*</sup></label>
            <input type="text" class="form-control" id="amountt" placeholder="Məs. 300" required><br>

            <select name="category" id="catsell" class="form-select" aria-label="Default select example" required>
            <option value="Choose Category">Kateqoriya Seçin<sup style="color:red;">*</sup></option>
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category->name ?>"><?php echo $category->name ?></option>
            <?php endforeach ?>
            </select>
            <br>
            <select name="currency" id="cursell" class="form-select" aria-label="Default select example" required>
            <option value="Choose Currency">Valyuta Seçin<sup style="color:red;">*</sup></option>
            <?php foreach ($currencies as $currency): ?>
            <option value="<?php echo $currency->name ?>"><?php echo $currency->name ?></option>
            <?php endforeach ?>
            </select>
            <label for="datetime" class="col-form-label">Tarix:<sup style="color:red;">*</sup></label>
            <input type="date" class="form-control" id="datee" required><br>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İmtina</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="incadd">Tamamla</button>
      </div>
    </div>
  </div>
</div>
	<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.jqueryui.min.js"></script>
<script>  
    $(document).ready(function(){ 
        $('#paymenttable').DataTable({
          "searching": false,
          "paging": false,
          "info": false
        }); 
    });
</script>
<script>  
    $(document).ready(function(){ 
        $('#incometable').DataTable({
          "searching": false,
          "paging": false,
          "info": false
        }); 
    });
</script>
    <script>

    	$(document).ready(function(){

      var notenough="<?php echo $this->session->userdata('notenough'); ?>";
       if (notenough) {
        alert(notenough);
        }
    		$('#catadd').click(function(){
    			var category=$('#catname').val();
    			$.ajax({
    				type:'post',
    				url: "<?=base_url()?>Maincontroller/addcategory",
    				data:{'category':category},
    				success:
    				function(data){
              if (data) {
                alert(data);
                console.log(data)
              }
              location.reload();
            }
    			});
    		})
    		$('#curadd').click(function(){
    			var name=$('#name').val();
    			var fullname=$('#fullname').val();
    			$.ajax({
    				type:'post',
    				url: "<?=base_url()?>Maincontroller/addcurrency",
    				data:{'name':name,'fullname':fullname},
    				success:
    				function(data){
              if (data) {
                alert(data);
                console.log(data)
              }
              location.reload();
            }
    			});
    		})
        $('#payadd').click(function(){
          var desc=$('#desc').val();
          var amount=$('#amount').val();
          var category=$('#catsel').val();
          var currency=$('#cursel').val();
          var date=$('#date').val();
          $.ajax({
            type:'post',
            url: "<?=base_url()?>Maincontroller/addpayment",
            data:{'desc':desc,'amount':amount,'category':category,'currency':currency,'date':date},
            success:
            function(data){
              if (data) {
                alert(data);
                console.log(data)
              }
              location.reload();
            }
          });
        })
        $('#incadd').click(function(){
          var desc=$('#descc').val();
          var amount=$('#amountt').val();
          var category=$('#catsell').val();
          var currency=$('#cursell').val();
          var date=$('#datee').val();
          $.ajax({
            type:'post',
            url: "<?=base_url()?>Maincontroller/addincome",
            data:{'desc':desc,'amount':amount,'category':category,'currency':currency,'date':date},
            success:
            function(data){
              alert(data);
              console.log(data)
              location.reload();
            }
          });
        })
        $("select[name='filterr']").change(function(){
          var currency=$( this ).val();
          $.ajax({
            type:'post',
            url: "<?=base_url()?>Maincontroller/curfilter",
            data:{'currency':currency},
            success:
            function(data){
              if (data) {
                $('.paymentbody').html(data);
                console.log(data)
              }
            }

          });
          
        })
        $("#catfilter").change(function(){
          var category=$( this ).val();
          $.ajax({
            type:'post',
            url: "<?=base_url()?>Maincontroller/catfilter",
            data:{'category':category},
            success:
            function(data){
              if (data) {
                $('#pymntbdy').html(data);
                console.log(data)
              }
            }

          });
          
        }) 
        $("#fltrbydate").click(function(){
          var initial=$("#initial").val();
          var end=$("#end").val();
          if (initial=='') {
            initial=false;
          }
          if(end==''){
            end=false;
          }
          $.ajax({
            type:'post',
            url: "<?=base_url()?>Maincontroller/datefilter",
            data:{'initial':initial,'end':end},
            success:
            function(data){
              if (data) {
                $('#pymntbdy').html(data);
                console.log(data)
              }
            }

          });
          
        })

    	})
    </script>
  </body>
</html>