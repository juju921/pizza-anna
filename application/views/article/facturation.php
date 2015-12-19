
<div id="body">

    <div class="wrapper">

        <h1> Facturation</h1>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>


        <?php echo form_open('article/facturation', array('class' => 'form-horizontal')); ?>

        <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <input type="text" name="email" placeholder="Email" value="<?php echo $this->user->email ?>">
                <?php echo form_error('email', '<span class="label label-important">', '</span>'); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Nom</label>
            <div class="controls">
                <input type="text" name="nom" placeholder="nom" value="<?php echo $this->user->nom ?>">
                <?php echo form_error('email', '<span class="label label-important">', '</span>'); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Jour de passage*: </label>
            <div class="controls">
            <select name="jours" id="jours">
                <option value="lundi">lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
                <option value="Samedi">Samedi</option>
                <option value="Dimanche">Dimanche</option>
            </select>
        </div>
        </div>
        <div class="control-group">
            <label class="control-label">Jour de passage*: </label>
            <div class="controls">
        <select name="ville" id="csi_ville" class="wg-formfield">
            <option value="antony" selected="">Antony</option>
            <option value="arcueil">Arcueil-Bagneux-Montrouge</option>
            <option value="fontenay_aux_roses-mouilleboeufs">Fontenay aux Roses - Carrefour des Mouilleboeufs</option>
            <option value="plessis-marche">Le Plessis Robinson - Place du marché</option>
            <option value="plessis-paulrivet">Le Plessis Robinson - rue Paul Rivet</option>
            <option value="plessis-resistance">Le Plessis Robinson - avenue de la Résistance</option>
            <option value="nanterre">Nanterre</option>
            <option value="paris">Paris</option>
            <option value="rosny">Rosny-sous-bois</option>
        </select>
            </div>
            </div>



        <div class="control-group">
            <label class="control-label">Heure de passage*:	</label>
            <div class="controls">
                <input type="text" name="heure" placeholder="Heure de passage" />

            </div>
        </div>



        <div class="control-group">
            <label class="control-label">Message :	</label>
            <div class="controls">
                <textarea id="message" class="wg-formfield" name="message" rows="5" cols="47"></textarea>

            </div>
        </div>


        <button type="submit" class="btn">Connexion</button>




        <?php echo form_close(); ?>






        </div>

    </div>
