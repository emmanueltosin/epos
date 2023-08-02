<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update Movies</div>
            <div class="panel-body">
                <?php
                $movies = $this->db->get_where('movies',array('SN'=>$this->uri->segment(3)))->row_array();
                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Movie Code</label>
                                <input type="text" required disabled value="<?php echo $movies['moviecode'] ?>" placeholder="Movie Code" class="form-control input-sm" name="moviecode"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Title</label>
                                <input type="text" value="<?php echo $movies['title'] ?>" required placeholder="Title" class="form-control input-sm" name="title"/>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Genre</label>
                                <select name="genre" required class="form-control input-sm">
                                    <?php
                                    foreach($this->stock->getGenre() as $genre) {
                                        ?>
                                        <option <?php echo $genre['SN']==$movies['genre'] ?> value="<?php echo $genre['SN'] ?>"><?php echo $genre['genre'] ?></option>
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
                                        <option <?php echo $movies['category']==$category['SN'] ? 'selected' : '' ?> value="<?php echo $category['SN'] ?>"><?php echo $category['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Run Time</label>
                                <input type="text" value="<?php echo $movies['duration'] ?>" required placeholder="Run Time" class="form-control input-sm" name="duration"/>
                            </div>
                            <div class="form-group">
                                <label>Movie Year</label>
                                    <input type="number" value="<?php echo $movies['movieyear'] ?>" placeholder="Enter Movie Year" class="form-control input-sm" name="movieyear">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                               <textarea class="form-control input-sm" name="description"><?php echo $movies['description'] ?></textarea>
                            </div>
                            <button class="btn btn-lg btn-primary" type="submit">Update Movie</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
