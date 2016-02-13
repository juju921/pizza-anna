<div id="body">

    <div class="wrapper">
        <div class="row-fluid">
            <div class="span3">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis cumque distinctio esse labore maxime sequi voluptatibus. Aut delectus eum ex excepturi in, nemo quae quisquam reiciendis soluta voluptatibus! Cumque, doloremque.</p>

            </div>
            <div class="span3">

                <?php if($this->session->flashdata('error')):?>
                    <div class="alert alert-error"><?php echo $this->session->flashdata('error');?></div>
                <?php endif;?>


                <?php echo form_open('login',array('class'=>'form-horizontal'));?>

                <div class="control-group">
                    <label class="control-label">Email : </label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
                    </div>
                </div>


                <div class="control-group">
                    <label for="mdp"  class="control-label">Mot de passse: </label>
                    <div class="controls">

                        <input type="password" id="mdp" name="mdp"/>
                    </div>
                </div>
                <button type="submit" class="btn">Connexion</button>


                <?php echo form_close();?>



            </div>
            <div class="span3">

        <?php if($this->session->flashdata('success')):?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
        <?php endif;?>

        <?php if(validation_errors()):?>
            <div class="alert alert-error"><?php echo validation_errors('<p>','</p>');?></div>
        <?php endif;?>

        <?php echo form_open('login',array('class'=>'form-horizontal'));?>
            <div class="control-group">
                <label class="control-label">Civilité :  </label>
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
                <div class="controls">
                    <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
                </div>
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

    </div>
</div>