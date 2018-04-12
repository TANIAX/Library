<?php ob_start(); ?>
<fieldset>
  <!-- Form Name -->
  <legend><h1>Edition article</h1></legend>
  <form class="form-horizontal" action="edit_article" method="post">
    <!-- Text input-->

    <?=$ERROR["UPDATED"];?>
    <?=$SUCCES["UPDATED"];?>
    <input type="text" hidden name="defaultid" value="<?=$article->article_id?>">
    <input type="text" hidden name="defaultisbn" value="<?=$article->article_isbn?>">
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_img"></label>
      <div class="col-md-4">
        <img src="<?=$article->article_image?>" alt="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="article_nom">Nom article*</label>
      <div class="col-md-4">
        <input id="article_nom" name="article_nom" type="text" placeholder="Nom de l'article" value="<?=$article->article_nom?>" class="form-control input-md">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="article_prix">prix article*</label>
      <div class="col-md-4">
        <input id="article_prix" name="article_prix" type="text" placeholder="Prix de l'article" value="<?=$article->article_prix?>" class="form-control input-md">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_date">Date*</label>
      <div class="col-md-4">
        <input id="article_date" name="article_date" type="date" value="<?=$article->article_date?>" class="form-control input-md">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_author">Auteur</label>
      <div class="col-md-4">
        <input id="article_author" name="article_author" type="text" placeholder="Auteur de l'article" value="<?=$article->article_auteur?>" class="form-control input-md">
      </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_editor">Éditeur</label>
      <div class="col-md-4">
        <input id="article_editor" name="article_editor" type="text" placeholder="Éditeur de l'article" value="<?=$article->article_editeur?>" class="form-control input-md">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_isbn">ISBN</label>
      <div class="col-md-4">
        <input id="article_isbn" name="article_isbn" type="text" placeholder="ISBN de l'article" value="<?=$article->article_isbn?>" class="form-control input-md">
      </div>
    </div>

    <!-- File Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="source_image">Image</label>
      <div class="col-md-4">
        <input id="article_image" name="article_image" type="text" placeholder="Lien de l'image | ex :http://res.cloudinary.com/dfencxbqa/image/upload/v..." value="<?=$article->article_image?>" class="form-control input-md">
      </div>
    </div>

    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_description">Description</label>
      <div class="col-md-4">
        <textarea class="form-control" id="article_description" name="article_description"><?=$article->article_description?></textarea>
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="article_categories">Categories</label>
      <div class="col-md-4">
        <select id="article_categories" name="article_categories" class="form-control">
          <option value="1">Bande déssinées</option>
          <option value="2">Comics</option>
          <option value="3">Livre</option>
          <option value="4">Figurine</option>
          <option value="5">Mangas</option>
          <option value="6">DVD</option>
          <option value="7">Jeux de plateaux</option>
          <option value="8">Jeux de carte</option>
          <option value="9">Affiches</option>
          <option value="10">Divers</option>
        </select>
      </div>
    </div>

    <!--submit-->
    <div class="form-group">
      <label class="col-md-4 control-label" ></label>
      <div class="col-md-4">
        <button class="btn btn-success" type="submit" name="update" value="<?=$article->article_id?>"><span class="glyphicon glyphicon-thumbs-up"></span>Editer</button>
      </div>
    </div>

  </fieldset>
</form>
<?php
$title = "Editer article";
$content = ob_get_clean();
include 'includes/layout.php'; ?>
