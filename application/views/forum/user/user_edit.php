<div class="row-fluid">
    
    <div class="span4" style="text-align: center;padding-top: 160px;"></div>
    <div class="span4">
        <div class="page-header">
            <h3 style="text-align:center;">Edit Akun</h3>
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
        <form class="well" action="" method="post" style="margin: 5px 10px;" enctype="multipart/form-data">
        <label>Username</label>
        <input type="text" disabled="disabled" value="<?php echo $user->username; ?>" class="span12" placeholder="">
        
        <label class="control-label" class="span12">Email</label>
        <input type="text" class="input-xlarge span12" value="<?php echo $user->email; ?>" name="row[email]" id="email">

        <label class="control-label" class="span12">No HP</label>            
        <input type="text" class="input-xlarge span12" value="<?php echo $user->hp; ?>" name="row[hp]" id="hp">
            
        <label class="control-label" class="span12">Foto</label>
        <input type="file" name="foto" > <br>
        <img src="<?php echo base_URL() . 'timthumb?src=/upload/' . $user->foto;?>&w=150&h=150&zc=0" style="margin-top: 10px;margin-bottom:10px" width="150"> 

        <label>Password</label>
        <input type="password" name="row[password]" class="span12" placeholder="">
        <label>Confirm Password</label>
        <input type="password" name="row[password2]" class="span12" placeholder="">
        <input type="submit" style="margin-top:15px;font-weight: bold;" name="btn-save" class="btn btn-primary btn-large" value="Simpan"/>
        </form>
    </div>
    
    <div class="span1">
        
    </div>
</div>