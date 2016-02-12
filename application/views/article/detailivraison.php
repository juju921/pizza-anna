<div id="body">
    <div class="wrapper">
        <h1>Détails commande</h1>

        <?php if ($this->session->flashdata('log')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('log'); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div class="alert alert-error"><?php echo validation_errors('<p>', '</p>'); ?></div>
        <?php endif; ?>
        <?php echo form_open('article/moyendepayent', array('class' => 'form-horizontal')); ?>
        <div class="control-group">
            <label class="control-label">Civilité : &nbsp; </label>
            <label class="checkbox inline" for="m">
                <input type="checkbox" id="m" value="Lundi" name="ville"> Lundi
            </label>
            <label class="checkbox inline" for="mme">
                <input type="checkbox" id="mme" value="Mardi" name="jour_livraison"> Mardi
            </label>
            <label class="checkbox inline" for="mlle">
                <input type="checkbox" id="mlle" value="Mercredi" name="jour_livraison"> Mercredi
            </label>
            <label class="checkbox inline" for="mlle">
                <input type="checkbox" id="mlle" value="Jeudi" name="jour_livraison"> Jeudi
            </label>
            <label class="checkbox inline" for="mlle">
                <input type="checkbox" id="mlle" value="Vendredi" name="jour_livraison"> Vendredi
            </label>
            <label class="checkbox inline" for="mlle">
                <input type="checkbox" id="mlle" value="Samedi" name="jour_livraison"> Samedi
            </label>
            <label class="checkbox inline" for="mlle">
                <input type="checkbox" id="mlle" value="Dimanche" name="jour_livraison"> Dimanche
            </label>
        </div>
        <div class="control-group">
            <label class="control-label">ville : </label>

            <div class="controls">

                <select id="ListeElement" name="ville">
                    <option selected="" value="antony">Antony</option>
                    <option value="arcueil">Arcueil-Bagneux-Montrouge</option>
                    <option value="fontenay_aux_roses-mouilleboeufs">Fontenay aux Roses - Carrefour des Mouilleboeufs
                    </option>
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
            <label class="control-label">heure : </label>

            <div class="controls">
                <input type="text" name="heure" placeholder="heure" value="<?php echo set_value('heure'); ?>">
            </div>
        </div>



        <div class="control-group">
            <label class="control-label">Téléphone : </label>

            <div class="controls">
                <input type="text" name="phone" placeholder="Téléphone" value="<?php echo set_value('phone'); ?>">
            </div>
        </div>
        <div class="control-group">
            <label for="mdp" class="control-label">message </label>

            <div class="controls">
                <textarea name="message" id="" cols="30" rows="10" placeholder="message" value="<?php echo set_value('message'); ?>"></textarea>

            </div>
        </div>
        <button type="submit" class="btn">Poursuivre ma commande</button>
        <?php echo form_close(); ?>
    </div>
</div>