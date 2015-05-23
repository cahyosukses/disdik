<div class="span10"> 
    <div class="page-header">
        <h1>Buat Akun Baru</h1>
    </div>
    <?php if (isset($tmp_success)): ?>
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        <h4 class="alert-heading">User created!</h4>
    </div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
    <div class="alert alert-error">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        <h4 class="alert-heading">Error!</h4>
        <?php if (isset($error['username'])): ?>
            <div>- <?php echo $error['username']; ?></div>
        <?php endif; ?>
        <?php if (isset($error['password'])): ?>
            <div>- <?php echo $error['password']; ?></div>
        <?php endif; ?>  
    </div>
    <?php endif; ?>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="input01">Username</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" name="row[username]" required>
                </div>
            </div>

            <div class="control-group">          
                <label class="control-label" for="input01">Email</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" name="row[email]" id="email" required>
                </div>
            </div>

            <div class="control-group">          
                <label class="control-label" for="input01">No HP</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" name="row[hp]" id="hp">
                </div>
            </div>

            <div class="control-group">          
                <label class="control-label" for="input01">Foto</label>
                <div class="controls">
                    <input type="file" name="foto" >  
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="input01">Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" name="row[password]" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input01">Confirm Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" name="password2" required>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="btn-create" class="btn btn-primary" value="Buat Akun Baru"/>
            </div>
        </fieldset>
       
    </form>
</div>