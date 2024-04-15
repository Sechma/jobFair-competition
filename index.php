<?php session_start(); ?>
<?php include 'header.php'; ?>
<?php if(isset($_SESSION['error'])): ?>
<div class="alert alert-danger m-0 py-4 text-center" role="alert">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
            </div>
<?php endif; ?>


    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-image">
        <img src="img/logo.png" alt="Logo" class="logo">     
        
        <div class="text-center">
            <h1 class="mb-4 text-warning welcome-txt">Ahoj serfaři/serfařko, ty si prý chceš chytnout svoji vlnu</h1>
            <form class="form-signin" action="step1.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Jméno">
                    <label for="name">Jméno hráče</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <label for="email">Email</label>
                </div>
                <div class="form-check mb-3 pt-2">
                    <input class="ms-1 form-check-input" type="checkbox" value="check" name="guideCheck" id="guideCheck">
                    <label class="form-check-label" for="guideCheck">
                        Nezapomeň průvodce veletrhem!
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Odeslat</button>
            </form>
        </div>
    </div>
<?php include 'footer.php'; ?>