<div class="span10">  
    <div class="page-header">
        <h1>Buat Kategori Baru</h1>
    </div>
    <form class="form-horizontal" method="post" action="">
        <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">Error!</h4>
            <?php if (isset($error['name'])): ?>
                <div>- <?php echo $error['name']; ?></div>
            <?php endif; ?>
            <?php if (isset($error['slug'])): ?>
                <div>- <?php echo $error['slug']; ?></div>
            <?php endif; ?>  
        </div>
        <?php endif; ?>  
        <?php if (isset($tmp_success)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">Kategori baru telah ditambahkan!</h4>
        </div>
        <?php endif; ?>
        <script>
          $(function() {
              $('#name').change(function() {
                  var name = $('#name').val().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
                  $('#slug').val(name);
              });
          });

      
          $(function(){
              $('#name').slugIt({
                  output: '#slug'
              });
           });
    
        </script>
        <fieldset>
          
          <div class="control-group">
            <label class="control-label" for="input01">Nama</label>
            <div class="controls">
              <input type="text" class="input-xlarge" name="row[name]" id="name">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="input01">Slug</label>
            <div class="controls">
              <input type="text" class="input-xlarge" name="row[slug]" id="slug">
              <p class="help-block">untuk alamat url</p>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="select01">Parent</label>
            <div class="controls">
              <select id="select01" name="row[parent_id]">
                <option value="0">-- none --</option>  
                <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>         

          <div class="control-group">
            <label class="control-label" for="input01">Users List</label>
            <div class="controls">
              <?php $users = $this->basecrud_m->get('forum_users');?>
              <select class="form-control chosen-select-deselect" multiple name="arr_user[]">
                <option value=""></option>
                <?php foreach($users->result() as $user) { ?>
                <option value="<?php echo $user->id;?>" /> <?php echo $user->username;?>
                <?php } ?>
              </select>
            </div>
          </div>

          
          <div class="form-actions">
            <input type="submit" name="btn-create" class="btn btn-primary" value="Buat Kategori"/>
          </div>
        </fieldset>
      </form>
          
</div>