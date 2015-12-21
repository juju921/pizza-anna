<div id="body">

    <div class="wrapper"> 
        <h1> Login</h1>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="row-fluid">
            <div class="span6">
        <?php echo form_open('user/login', array('class' => 'form-horizontal')); ?>

        <div class="control-group">
            <p>Vous Avez un compte</p>

            <label class="control-label">Email</label>
            <div class="controls">
                <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                <?php echo form_error('email', '<span class="label label-important">', '</span>'); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Mot de passe</label>
            <div class="controls">
                <input type="password" name="mdp" placeholder="Mot de passe" value="<?php echo set_value('mdp'); ?>">
                <?php echo form_error('password', '<span class="label label-important">', '</span>'); ?>
                <p><a href="<?php echo site_url('user/forget'); ?>">J'ai oublié mon mot de passe.</a></p>
            </div>
        </div>

        <button type="submit" class="btn">Connexion</button>


        <p><a href="<?php echo site_url('user/inscription'); ?>">Inscription.</a></p>

        <?php echo form_close(); ?>
            </div>

            <div class="span6">

                <?php echo form_open('user/inscriptions', array('class' => 'form-horizontal')); ?>

                <div class="control-group">
                    <p>S'inscrire</p>
                    <label class="control-label">Email</label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<span class="label label-important">', '</span>'); ?>
                    </div>
                </div>


                <button type="submit" class="btn">Connexion</button>
                <p><a href="">Payer sans ce créer de compte</a></p>


                <?php echo form_close(); ?>

            </div>

        </div>


    </div>
</div>