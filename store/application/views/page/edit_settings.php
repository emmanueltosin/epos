<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">Application Settings</div>
            <div class="tab-container">
                <div class="tab-content">
                    <div id="home" class="tab-pane active cont">
                        <div class="row">
                            <?php
                            $user =$this->users->get_user_by_id($this->uri->segment(3),1);
                            ?>
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel panel-heading">Update User(s)</div>
                                    <?php

                                    ?>
                                    <div class="panel-body">
                                        <form action="<?php  echo base_url('dashboard/edit_settings/'.$this->uri->segment(3));  ?>" method="post" accept-charset="utf-8">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="extra[firstname]" autocomplete="OFF" value="<?php echo $user->firstname ?>" id="firstname" maxlength="20" size="30" required="" placeholder="First Name" autocomplete="off" class="input-sm form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="extra[lastname]" autocomplete="OFF" value="<?php echo $user->lastname ?>" id="lastname" maxlength="20" size="30" required="" placeholder="Last Name" autocomplete="off" class="input-sm form-control">
                                            </div>

                                                <input type="hidden" name="extra[bank_name]" autocomplete="OFF" value="<?php echo $user->bank_name ?>" id="bank_name" maxlength="20" size="30" required="" placeholder="Bank Name" autocomplete="off" class="input-sm form-control">


                                            <input type="hidden" name="extra[bank_account_name]" autocomplete="OFF" value="<?php echo $user->bank_account_name ?>" id="account_name" maxlength="20" size="30" required="" placeholder="Account Name" autocomplete="off" class="input-sm form-control">


                                            <input type="hidden" name="extra[bank_account_no]" autocomplete="OFF" value="<?php echo $user->bank_account_no ?>" id="account_number" maxlength="20" size="30" required="" placeholder="Account Number" autocomplete="off" class="input-sm form-control">


                                            <input type="hidden" name="extra[salary]" autocomplete="OFF" value="<?php echo $user->salary ?>" id="salary" maxlength="20" size="30" required="" placeholder="Salary" autocomplete="off" class="input-sm form-control">

                                            <input type="hidden" name="username" value="<?php echo $user->username ?>" autocomplete="OFF" value="" id="username" maxlength="20" size="30" required="" placeholder="Username" autocomplete="off" class="input-sm form-control">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" autocomplete="OFF" value="<?php echo $user->username ?>" id="username" maxlength="20" size="30" required="" placeholder="Username" autocomplete="off" class="input-sm form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" name="email" value="<?php echo $user->email?>" autocomplete="OFF"  id="email" maxlength="80" size="30" required="" placeholder="E-mail" autocomplete="off" class="input-sm form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label>
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
                                                <select required class="form-control input-sm" name="department" onchange="return show_role(this.value)">
                                                    <option>-Select Department-</option>
                                                    <?php
                                                    foreach($department as $key=>$dpt){
                                                    ?>
                                                        <option <?php echo $key==$user->department ? 'selected' : ''  ?> value="<?php echo $key ?>"><?php echo $key ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Role</label>
                                                <select required class="form-control input-sm" id="role" required name="role">
                                                    <?php
                                                    foreach($department[$user->department] as $role) {
                                                        ?>
                                                    <option <?php echo $role==$user->role ? 'selected' : ''  ?> value="<?php  echo $role ?>"><?php  echo $role ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                            <label>Branch</label>
                                                <select required class="form-control input-sm" onchange="return show_role(this.value)" name="branch_id"> 
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
                                    </div>
                                    <div class="form-group xs-pt-10">
                                        <input type="submit" value="Update User" class="btn btn-block btn-primary btn-xl">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<script>
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