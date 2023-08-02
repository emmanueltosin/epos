<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">New Movies</div>
            <div class="panel-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Movie Code</label>
                                <input type="text" required readonly value="MOV<?php echo mt_rand(); ?>" placeholder="Movie Code" class="form-control input-sm" name="moviecode"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Title</label>
                                <input type="text" required placeholder="Title" class="form-control input-sm" name="title"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Genre</label>
                                <select name="genre" required class="form-control input-sm">
                                    <option value="">Select Genre</option>
                                    <?php
                                    foreach($this->stock->getGenre() as $genre) {
                                        ?>
                                        <option value="<?php echo $genre['SN'] ?>"><?php echo $genre['genre'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Category</label>
                                <select name="category" required class="form-control input-sm">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach($this->stock->getServiceCategories() as $category) {
                                        ?>
                                        <option value="<?php echo $category['SN'] ?>"><?php echo $category['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Run Time</label>
                                <input type="text" required placeholder="Run Time" class="form-control input-sm" name="duration"/>
                            </div>
                            <div class="form-group">
                                <label>Movie Year</label>
                                    <input type="number" placeholder="Enter Movie Year" class="form-control input-sm" name="movieyear">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                               <textarea class="form-control input-sm" name="description"></textarea>
                            </div>
                            <button class="btn btn-lg btn-primary" type="submit">Add Movies</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
