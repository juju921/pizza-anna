<div id="body">
    <div class="wrapper">
        <h1>Inscription</h1>



        <?php if($this->session->flashdata('log')):?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('log');?></div>
        <?php endif;?>

        <?php if($this->session->flashdata('success')):?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
        <?php endif;?>
        <?php if(validation_errors()):?>
        <div class="alert alert-error"><?php echo validation_errors('<p>','</p>');?></div>
        <?php endif;?>
        <?php echo form_open('user/inscription',array('class'=>'form-horizontal'));?>
        <div class="control-group">
            <label class="control-label">Civilité : &nbsp; </label>
            <label class="checkbox inline" for="m">
                <input type="checkbox" id="m" value="m" name="civilite" > M.
            </label>
            <label class="checkbox inline" for="mme">
                <input type="checkbox" id="mme" value="mme" name="civilite" > Mme
            </label>
            <label class="checkbox inline" for="mlle">
                <input type="checkbox" id="mlle" value="mlle" name="civilite">Mlle
            </label>
        </div>
        <div class="control-group">
            <label class="control-label">Nom : </label>
            <div class="controls">
                <input type="text" name="lastname" placeholder="Nom" value="<?php echo set_value('lastname');?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Prénom : </label>
            <div class="controls">
                <input type="text" name="firstname" placeholder="Prénom" value="<?php echo set_value('firstname');?>">
            </div>
        </div>
        <div class="control-group">
            <label for="mdp"  class="control-label">Mot de passse: </label>
            <div class="controls">
                <input type="password" id="mdp" name="mdp"/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Email : </label>

            <?php if($this->session->flashdata('vars')):?>
                <div class="controls">
                    <input type="text" name="email" placeholder="Email" value="<?php  echo $this->session->flashdata('vars');?>">
                </div>


            <?php else: ?>

            <div class="controls">
                <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
            </div>

            <?php endif;?>

        </div>
        <div class="control-group">
            <label class="control-label">Téléphone : </label>
            <div class="controls">
                <input type="text" name="phone" placeholder="Téléphone" value="<?php echo set_value('phone');?>">
            </div>
        </div>
        <button type="submit" class="btn">Poursuivre ma commande</button>
        <?php echo form_close();?>
    </div>
</div>