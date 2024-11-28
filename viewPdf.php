
<?php include_once ('includes/header.php') ?>

<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $_SESSION['pdf_id']=$id;
    } else if (isset($_SESSION['pdf_id'])){
        $id= $_SESSION['pdf_id'];
    }
    $thisBook=getFileById($conn, $id);
  
?>
<main>
<div class="container-fluid">
    <h3 class="text-primary mb-3 "><?=$thisBook['name']?></h3>
    <iframe class="pdf" src="<?=$thisBook['file']?>" width="100%" height="500" style="overflow:hidden;"></iframe>
</div>
</main>
<?php include_once ('includes/footer.php') ?>