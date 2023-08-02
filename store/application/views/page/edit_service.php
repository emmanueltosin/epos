<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Update Service</div>
            <div class="panel-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Service Code</label>
                                <input type="text" required readonly value="<?php echo $service['servicecode'] ?>" placeholder="Service Code" class="form-control input-sm" name="servicecode"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input type="text" required placeholder="Name" value="<?php echo $service['name'] ?>" class="form-control input-sm" name="name"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Price</label>
                                <input type="text" required placeholder="Price" value="<?php echo $service['price'] ?>" class="form-control input-sm" name="price"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Category</label>
                                <select name="category" required class="form-control input-sm">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach($this->stock->getServiceCategories() as $category) {
                                        ?>
                                        <option <?php echo $service['category']==$category['SN'] ? 'selected' : '' ?> value="<?php echo $category['SN'] ?>"><?php echo $category['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            $user_id = $this->tank_auth->get_user_id();
                            $user = $this->db->get_where("users",array("SN"=>$user_id))->row_array();
                            if($user['department'] =='Top Administrator'){
                            ?>
                            <div class="form-group">
                                <label>Department</label>
                                <select required class="form-control input-sm" name="department">
                                    <option value="">Select Department</option>
                                    <?php
                                        $departments = $this->db->get_where('department',array('type'=>'Service'))->result_array();
                                        foreach($departments as $department) {
                                            ?>
                                            <option <?php echo $service['department']==$department['department'] ? 'selected' : '' ?> value="<?php echo $department['department'] ?>"><?php echo $department['department'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php
                                }else {
                                ?>
                                <input type="hidden" value="<?php echo $service['department'] ?>" name="department"/>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <label>Description</label>
                               <textarea class="form-control input-sm" name="description"><?php echo $service['description']  ?></textarea>
                            </div>
                            <button class="btn btn-lg btn-primary" type="submit">Update Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
