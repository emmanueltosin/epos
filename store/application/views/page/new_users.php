<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
                <div class="panel-heading">Add New User / Staff
                    <div class="tools">
                        <a href="<?php echo base_url('dashboard/settings') ?>" class="btn btn-sm btn-primary">View user</a>
                    </div>
                </div>
            <div class="panel-body">
                <form action="<?php  echo base_url('dashboard/settings');  ?>" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="extra[firstname]" autocomplete="OFF" value="" id="firstname" maxlength="20" size="30" required="" placeholder="First Name" autocomplete="off" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="extra[lastname]" autocomplete="OFF" value="" id="lastname" maxlength="20" size="30" required="" placeholder="Last Name" autocomplete="off" class="input-sm form-control">
                    </div>
                        <input type="hidden" name="extra[bank_name]" autocomplete="OFF" value="" id="bank_name" maxlength="20" size="30" required="" placeholder="Bank Name" autocomplete="off" class="input-sm form-control">

                        <input type="hidden" name="extra[bank_account_name]" autocomplete="OFF" value="" id="account_name" maxlength="20" size="30" required="" placeholder="Account Name" autocomplete="off" class="input-sm form-control">

                        <input type="hidden" name="extra[bank_account_no]" autocomplete="OFF" value="" id="bank_account_no" maxlength="20" size="30" required="" placeholder="Account Number" autocomplete="off" class="input-sm form-control">

                        <input type="hidden" name="extra[salary]" autocomplete="OFF" value="0" id="salary" maxlength="20" size="30" required="" placeholder="Salary" autocomplete="off" class="input-sm form-control">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" autocomplete="OFF" value="" id="username" maxlength="20" size="30" required="" placeholder="Username" autocomplete="off" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="" autocomplete="OFF"  id="email" maxlength="80" size="30" required="" placeholder="E-mail" autocomplete="off" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="" id="password" maxlength="20" size="30" required="" class="input-sm form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select required class="form-control input-sm" onchange="return show_role(this.value)" name="extra[department]">
                            <?php
                            $dpts = $this->stock->getDepartments();
                            $department = array(
                                'Store'=> array('Stock Officer'),
                                'Cinema'=>array('Sales Representative','Administrator'),
                                'Top Administrator'=> array('Top Administrator'),
                            );
                            foreach($dpts as $dpt){
                                $department[$dpt['department']] = array('Sales Representative','Administrator');
                            }
                            ?>
                            <option>-Select Department-</option>
                            <?php
                            foreach($department as $key=>$dpt){
                            ?>
                            <option value="<?php echo $key ?>"><?php echo $key ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select required id="role" class="form-control input-sm" required name="role">
                            <option>-Select Role-</option>
                        </select>
                    </div>

                    <div class="form-group">
                    <label>Branch</label>
                        <select required class="form-control input-sm" onchange="return show_role(this.value)" name="extra[branch_id]"> 
                        <option>--select option--</option>
                        <?php 
                            $bbs =$this->stock->getBranches();
                           
                            foreach($bbs as $bb){
                                ?>
                                 <option value="<?php echo  $bb['SN'] ?>"><?php echo $bb['branch_name'] ?></option>
                                <?php
                                } 
                           ?>
                        </select>
                    </div>
                    

                    <div class="form-group xs-pt-10">
                        <input type="submit" value="Add User" class="btn btn-block btn-primary btn-xl">
                    </div>
                </form>
            </div>
	</div>
</div>
    <?php
    $dpts = $this->stock->getDepartments();
    $department = array(
        'Store'=> array('Stock Officer'),
        'Cinema'=>array('Sales Representative','Administrator'),
        'Top Administrator'=> array('Top Administrator'),
    );
    foreach($dpts as $dpt){ 
        $department[$dpt['department']] = array('Sales Representative', 'Administrator', 'Stock Officer'); 
    }
    ?>
    <script>


        function show_role(value){
            var opt = JSON.parse('<?php echo json_encode($department) ?>');
            var role = opt[value];
            var html = '';
            for(var i=0; i < role.length; i++){
                html+='<option value="'+role[i]+'">'+role[i]+'</option>';
            }
            $('#role').html(html);
        }
    </script>