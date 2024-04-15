<?php
session_start();

if (empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['guideCheck'])) {
    $_SESSION['error'] = "Všechna pole jsou povinná!";
    header("Location: index.php");
    exit;
}
else {
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $data = "Jméno: $fname, Email: $email\n";
        file_put_contents("results.txt", $data, FILE_APPEND | LOCK_EX);
?>
<?php include 'header.php'; ?>
     <div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-image">
        <img src="img/logo.png" alt="Logo" class="logo">
        <div class="text-center">
            <h1 class="mb-4 text-warning welcome-txt py-4 mb-3">Vyber si svůj surf!</h1>
            <form action="step2.php" method="post" class="py-3 row">
                <!-- Strojní -->
                <div class="col-6 col-md-4 mb-3 selectable-col">
                    <label for="field_strojni">
                        Strojní
                        <img src="img/surf1.svg" alt="IT" width="50px" height="50px">
                        <input type="radio" id="field_strojni" name="field" value="strojni" class="d-none">
                    </label>
                </div>
                <!-- IT -->
                <div class="col-6 col-md-4 mb-3 selectable-col">
                    <label for="field_it">
                        IT
                        <img src="img/surf2.svg" alt="IT" width="50px" height="50px">
                        <input type="radio" id="field_it" name="field" value="it" class="d-none">
                    </label>
                </div>
                <!-- Stavební -->
                <div class="col-6 col-md-4 mb-3 selectable-col">
                    <label for="field_stavebni">
                        Stavební
                        <img src="img/surf3.svg" alt="IT" width="50px" height="50px">
                        <input type="radio" id="field_stavebni" name="field" value="stavebni" class="d-none">
                    </label>
                </div>
                <!-- Elektro -->
                <div class="col-6 col-md-4 mb-3 selectable-col">
                    <label for="field_elektro">
                        Elektro
                        <img src="img/surf5.svg" alt="IT" width="50px" height="50px">
                        <input type="radio" id="field_elektro" name="field" value="elektro" class="d-none">
                    </label>
                </div>
                <!-- Chemická -->
                <div class="col-6 col-md-4 mb-3 selectable-col">
                    <label for="field_chemicka">
                        Chemická
                        <img src="img/surf6.svg" alt="IT" width="50px" height="50px">
                        <input type="radio" id="field_chemicka" name="field" value="chemicka" class="d-none">
                    </label>
                </div>
                <!-- Ekonomie -->
                <div class="col-6 col-md-4 mb-3 selectable-col">
                    <label for="field_ekonomie">
                        Ekonomie
                        <img src="img/surf7.svg" alt="IT" width="50px" height="50px">
                        <input type="radio" id="field_ekonomie" name="field" value="ekonomie" class="d-none">
                    </label>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="px-4 btn btn-primary">Odeslat</button>
                </div>
            </form>
        </div>
    </div>        
<?php 
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var labels = document.querySelectorAll('.selectable-col label');
    labels.forEach(function(label) {
        label.addEventListener('click', function() {
            labels.forEach(function(otherLabel) {
                otherLabel.parentElement.classList.remove('selected');
            });
            label.parentElement.classList.add('selected');
        });
    });
});
</script>

<?php include 'footer.php'; ?>
