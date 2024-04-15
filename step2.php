<?php
session_start();
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

function addToHistory(&$history, $item, $limit = 5) {
    if (!in_array($item, $history)) {
        array_unshift($history, $item);
        if (count($history) > $limit) {
            array_pop($history);
        }
    }
}
function normalizeCzechChars($string) {
    $czechChars = [
        'á' => 'a', 'č' => 'c', 'ď' => 'd', 'é' => 'e', 'ě' => 'e', 'í' => 'i', 
        'ň' => 'n', 'ó' => 'o', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ú' => 'u', 
        'ů' => 'u', 'ý' => 'y', 'ž' => 'z',
    ];
    
    return strtr($string, $czechChars);
}

include 'fields.php';
$valueIncorrect = false;

if (isset($_POST['field']) && $_POST['field'] !== "") {
    $_SESSION['field'] = $_POST['field'];
}
$field = $_SESSION['field'];

if (!isset($_SESSION['submissionsCount'])) {
    $_SESSION['submissionsCount'] = 1;
    if(isset($$field)) {
        $unique = false;
        while (!$unique) {
            $randomKey = array_rand($$field);
            $randomVal = $$field[$randomKey];
    
            if (!in_array($randomKey, $_SESSION['history'])) {
                $unique = true;
                addToHistory($_SESSION['history'], $randomKey);
                $_SESSION['expected_val'] = $randomVal;
            }
        }
    }
}

else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['keyWord'])) {

    $submittedKeyWord = normalizeCzechChars(strtolower($_POST['keyWord']));
    $expectedVal = normalizeCzechChars(strtolower($_SESSION['expected_val']));

    if($expectedVal != $submittedKeyWord ) {
        $valueIncorrect = true;
        $randomKey = reset($_SESSION['history']);
        $randomVal = $_SESSION['expected_val'];
    }
    else {
        $_SESSION['submissionsCount'] += 1;

        if(isset($$field)) {
            $unique = false;
            while (!$unique) {
                $randomKey = array_rand($$field);
                $randomVal = $$field[$randomKey];
        
                if (!in_array($randomKey, $_SESSION['history'])) {
                    $unique = true;
                    addToHistory($_SESSION['history'], $randomKey);
                    $_SESSION['expected_val'] = $randomVal;
                }
            }
        }
    }
}
else {
    $randomKey = reset($_SESSION['history']);
    $randomVal = $_SESSION['expected_val'];
   
}
if ($_SESSION['submissionsCount'] >= 4) {
  
    $_SESSION['submissionsCount'] = 1;
    header('Location: final.php');
    exit();
}


?>
<?php include 'header.php'; ?>
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-image">
    <img src="img/logo.png" alt="Logo" class="logo">
        <div class="text-center">
            <div class="container mt-4">
                <form action="step2.php" method="post"  id="keywordForm" data-randomval="<?php echo htmlspecialchars($randomVal); ?>">
                    <div id="counter" class="<?php echo $_SESSION['submissionsCount'] == 1 ? 'green' : ($_SESSION['submissionsCount'] == 2 ? 'yellow' : 'blue'); ?>">
                        <?php echo $_SESSION['submissionsCount']; ?> / 3
                    </div>
                    <div class="mb-3">
                        <label for="keyWord" class="form-label"> Zeptej se firmy <strong><?php echo $randomKey; ?></strong> na klíčové slovo hry:</label>
                        <input type="text" class="form-control" id="keyWord" name="keyWord" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Odeslat</button>
                </form>
                <?php if ($valueIncorrect): ?>
                    <div class="mt-3" style="color: red;">Není to ono, zkus to znova! </div>
                <?php endif; ?>
            </div>
        </div>
</div>
<?php include 'footer.php'; ?>