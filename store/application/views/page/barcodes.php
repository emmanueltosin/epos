<table align="center" cellpadding="10" cellspacing="10">
					<?php 
						$generate_num = (int)$_POST['num'];
						$row = ($generate_num/4);
						$row = ceil($row);
						$code = rand(10000, 999999999);
						for($num=1; $num<=$row; $num++){
					?>
					<tr>
						<td><img style="width:100%" src="<?php echo base_url('dashboard/generateBarcode/BAR-'.$code); ?>"/></td>
						<td><img style="width:100%" src="<?php echo base_url('dashboard/generateBarcode/BAR-'.$code); ?>"/></td>
						<td><img style="width:100%" src="<?php echo base_url('dashboard/generateBarcode/BAR-'.$code); ?>"/></td>
						<td><img style="width:100%" src="<?php echo base_url('dashboard/generateBarcode/BAR-'.$code); ?>"/></td>
					</tr>
					<?php 
						}
					?>
				</table>